<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LanguageRequest;
use App\Models\Language;

class LanguageController extends Controller
{
    // 获取语言列表
    public function allLocales()
    {
        $list = Language::get()->toArray();
        $tree = buildTree($list);  // 整理成树形结构
        treeUnfold($tree);  // 为每项加上父级前缀
        $zh_CN = [];
        $en_US = [];
        $ja_JP = [];
        $zh_TW = [];
        getLocale($tree, $zh_CN, 'zh-CN');
        getLocale($tree, $en_US, 'en-US');
        getLocale($tree, $ja_JP, 'ja-JP');
        getLocale($tree, $zh_TW, 'zh-TW');
        $data = [
            'zh-CN' => $zh_CN,
            'en-US' => $en_US,
            'ja-JP' => $ja_JP,
            'zh-TW' => $zh_TW,
        ];
        return $this->success($data, __('messages.success'));
    }

    // 列表
    public function list(LanguageRequest $request)
    {
        $search_param = $request->only(['name', 'start_time', 'end_time', 'order_by', 'is_menu']);
        $model = new Language;
        if (isset($search_param['name'])) {
            $model = $model->where('name', 'like', '%'.$search_param['name'].'%');
        }
        if (isset($search_param['start_time'])) {
            $model = $model->whereBetween('create_at', [$search_param['start_time'], $search_param['end_time']]);
        }
        if (isset($search_param['order_by'])) {
            foreach ($search_param['order_by'] as $order_by) {
                $model = $model->orderBy($order_by[0], $order_by[1]);
            }
        }

        $list = $model->get()->toArray();
        $tree = buildTree($list);
        treeClearNullArr($tree);
        $data = $tree;
        if (isset($search_param['is_menu']) && $search_param['is_menu']) {
            // 只提取出 menu 数据
            foreach ($tree as $item) {
                if ($item['name'] == 'menu') {
                    $data = $item['children'];
                }
            }
        }
        return $this->success($data, __('messages.success'));
    }

    // 创建
    public function store(LanguageRequest $request)
    {
        $username      = $request -> get('username');
        $data = array_merge($request->only(['parent_id', 'name', 'zh-CN', 'en-US', 'ja-JP', 'zh-TW', 'sort']), ['create_by'=>$username]);
        if (Language::create($data)) {
            return $this->ok(__('messages.create_success'));
        } else {
            return $this->failed(__('messages.create_fail'));
        }
    }

    // 更新
    public function update(LanguageRequest $request)
    {
        $id = $request->input('id');
        $username = $request -> get('username');
        $language = Language::find($id);
        $update_data = array_merge($request->only(['parent_id', 'name', 'zh-CN', 'en-US', 'ja-JP', 'zh-TW', 'sort']),['update_by'=>$username]);
        if ($language->update($update_data)) {
            return $this->ok(__('messages.modify_success'));
        } else {
            return $this->failed(__('messages.modify_fail'));
        }
    }

    // 删除
    public function destroy(LanguageRequest $request)
    {
        $input = $request->all();
        $username = $request -> get('username');
        $language = Language::find($input['id']);
        $update_data = ['update_by'=>$username,'delete_at'=> time()];
        if ($language && $language->update($update_data)) {
            return $this->ok(__('messages.delete_success'));
        } else {
            return $this->failed(__('messages.delete_fail'));
        }
    }
}
