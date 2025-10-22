<?php

/*********************************************************************
函数名称:encrypt
函数作用:加密解密字符串
使用方法:
加密     :encrypt('str','E','nowamagic');
解密     :encrypt('被加密过的字符串','D','nowamagic');
参数说明:
$string   :需要加密解密的字符串
$operation:判断是加密还是解密:E:加密   D:解密
$key      :加密的钥匙(密匙);
 *********************************************************************/
function my_encrypt($string,$operation,$key='') {
    $key=md5($key);
    $key_length=strlen($key);
    $string=$operation=='D'?base64_decode($string):substr(md5($string.$key),0,8).$string;
    $string_length=strlen($string);
    $rndkey=$box=array();
    $result='';
    for($i=0;$i<=255;$i++) {
        $rndkey[$i]=ord($key[$i%$key_length]);
        $box[$i]=$i;
    }
    for($j=$i=0;$i<256;$i++) {
        $j=($j+$box[$i]+$rndkey[$i])%256;
        $tmp=$box[$i];
        $box[$i]=$box[$j];
        $box[$j]=$tmp;
    }
    for($a=$j=$i=0;$i<$string_length;$i++) {
        $a=($a+1)%256;
        $j=($j+$box[$a])%256;
        $tmp=$box[$a];
        $box[$a]=$box[$j];
        $box[$j]=$tmp;
        $result.=chr(ord($string[$i])^($box[($box[$a]+$box[$j])%256]));
    }
    if($operation=='D') {
        if(substr($result,0,8)==substr(md5(substr($result,8).$key),0,8)) {
            return substr($result,8);
        } else {
            return'';
        }
    } else {
        return str_replace('=','',base64_encode($result));
    }
}

/**
 * 迭代器方法，实现无限分类树
 * @param array $array 原始数据包
 * @return array
 */
function buildTree($array) {
    if (empty($array)) {
        return [];
    }
    $map = array();
    $fotmatTree = array();
    foreach ($array as &$vo) {
        $map[$vo['id']] = &$vo;
        $map[$vo['id']]['children'] = array();
    }
    unset($vo);
    foreach ($array as &$item) {
        $parent = &$map[$item['parent_id']];
        if (empty($parent)) {
            $fotmatTree[] = &$item;
        } else {
            $parent['children'][] = &$item;
        }
    }
    unset($map);
    return $fotmatTree;
}

/**
 * 为原数组清除空的子集
 * @param array &$array 原始数据包
 * @return void
 */
function treeClearNullArr(&$array)
{
    if (empty($array)) {
        return;
    }
    foreach ($array as $k => $item) {
        if (count($item['children'])>0) {
            treeClearNullArr($array[$k]['children']);
        } else {
            unset($array[$k]['children']);
        }
    }
}

/**
 * 为原数组清除重定向数据
 * @param array &$tree 原始数据包
 * @return void
 */
function treeClearRedirect(&$tree)
{
    foreach ($tree as $key => &$node) {
        if ($node['redirect'] !== null) {
            unset($tree[$key]);
            return;
        }
        if (count($node['children'])>0) {
            treeClearRedirect($node['children']);
        }
    }
}

/**
 * 为原数组每一项添加上父级前缀
 * @param array &$array 原始数据包
 * @return void
 */
function treeUnfold(&$array, $key = '') {
    foreach ($array as $k => $item) {
        if ($key != '') {
            $path = $key. '.' .$item['name'];
        } else {
            $path = $item['name'];
        }
        if (count($item['children'])>0) {
            treeUnfold($array[$k]['children'], $path);
        }
        $array[$k]['path'] = $path;
    }
}

/**
 * 获取国际化列表
 * @param array $array 树形结构数据包
 * @param array &$temp 临时数组
 * @param string $locale 需要获取的语种
 * @return void
 */
function getLocale($array, &$temp, $locale='zh-CN') {
    foreach ($array as $item) {
        if (count($item['children'])>0) {
            getLocale($item['children'], $temp, $locale);
        }
        if ($item['zh-CN'] !== null) {
            $temp[$item['path']] = $item[$locale];
        }
    }
}

/**
 * 验证时间格式是否是指定格式
 * @param string $time 时间字符串
 * @param string $format 时间格式
 * @return boolean
 */
function validateTimeFormat($time, $format = 'Y-m-d H:i:s') {
    $d = DateTime::createFromFormat($format, $time);
    return $d && $d->format($format) === $time;
}

/**
 * 字符串转时间戳函数
 * return int
 */
function strToUinxTime($string) {
    $uinxtime = strtotime($string);
    if ($uinxtime === false) {
        return 0;
    } else {
        return $uinxtime;
    }
}

/**
 * 通过子级id获取所有父级
 * return array
 */
function getParentItems($child_id, &$datas) {
    $parents = array();
    // 查找当前子级ID的直接父级
    foreach ($datas as $item) {
        if ($item['id'] == $child_id) {
            $parents[] = $item;
            if ($item['parent_id'] > 0) {
                // 递归调用获取更高一级的父级
                $parents = array_merge(getParentItems($item['parent_id'], $datas), $parents);
            }
            break;
        }
    }
    return $parents;
}

/**
 * 通过父级id获取所有子级
 * return array
 */
function getChildItems($parent_id, &$datas) {
    $childs = [];
    // 查找当前子级ID的直接父级
    foreach ($datas as $item) {
        if ($item['parent_id'] == $parent_id) {
            $childs[] = $item;
            $childs = array_merge(getChildItems($item['id'], $datas), $childs);
        }
    }
    return $childs;
}

/**
 * 树型结构排序
 * @param $tree
 * @return mixed
 */
function sortTree($tree)
{
    if (empty($tree)) {
        return $tree;
    }
    foreach ($tree as $key => $item) {
        if (isset($item['children'])) {
            $tree[$key]['children'] = sortTree($item['children']);
        }
    }
    $cmf_arr = array_column($tree, 'sort');
    array_multisort($cmf_arr, SORT_ASC, $tree);
    return $tree;
}


