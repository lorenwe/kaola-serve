<?php
namespace App\Services;

use App\Models\AdminApi;
use App\Models\AdminRoleMenu;
use App\Models\Menu;

class  AdminRoleMenuService extends BaseService
{
    // 更新角色菜单关联关系
    public function updateRoleMenu($role_id, $role_menus)
    {
        // 查询menu数据
        $field = ['menu.id', 'menu.id as menu_id', 'menu.menu_api', 'menu.parent_id', 'language.zh-CN', 'language.zh-CN as menu_name'];
        $list  = Menu::select($field)
            ->leftJoin('language', 'language.id', '=', 'menu.language_id')
            ->get()->toArray();
        // 获取所有菜单的父级ID
        $menus_item = [];
        foreach ($role_menus as $menu_id) {
            $menus_item = array_merge($menus_item, getParentItems($menu_id, $list));
        }
        $menu_ids = [];
        foreach ($menus_item as $menu) {
            array_push($menu_ids, $menu['id']);
        }
        $menu_all_ids = array_values(array_unique($menu_ids));
        $menu_all_str = implode(',', $menu_all_ids);
        $menu_ids     = implode(',', $role_menus);

        // 获取所有菜单的依赖接口ID
        $menu_apis = [];
        foreach ($list as $menu) {
            foreach ($menu_all_ids as $menu_id) {
                if ($menu['id'] == $menu_id) {
                    if ($menu['menu_api']) {
                        array_push($menu_apis, ...array_map('intval', explode(',', $menu['menu_api'])));
                    }
                }
            }
        }
        // 获取所有接口
        $api_list  = AdminApi::select(['id','parent_id','api_name','api_path','method','api_type'])->where('status', 1)->get()->toArray();
        // 获取公共接口
        $api_pub   = getChildItems(24, $api_list);
        // 过滤掉 dir 数据
        $api_pub_arr  = [];  // 公共接口id列表
        $api_pub_list = [];  // 公共接口列表
        foreach ($api_pub as $api) {
            if ($api['api_type'] == 'api') {
                array_push($api_pub_arr, $api['id']);
                array_push($api_pub_list, $api);
            }
        }
        // 获取菜单依赖的接口
        if (!empty($menu_apis)) {
            $api_menu_arr  = [];
            $api_menu_list = [];
            foreach ($api_list as $api) {
                foreach ($menu_apis as $api_id) {
                    if ($api_id == $api['id'] && $api['api_type'] == 'api') {
                        array_push($api_menu_arr, $api['id']);
                        array_push($api_menu_list, $api);
                    }
                }
            }
            $api_ids_all  = array_merge($api_pub_arr, $api_menu_arr);
            $api_list_all = array_merge($api_pub_list, $api_menu_list);
            $api_ids = implode(',', $api_ids_all);
            AdminRoleService::getInstance()->setPermissions($api_list_all, $role_id); // 更新 Casbin 权限
        } else {
            $api_ids = implode(',', $api_pub_arr);
            AdminRoleService::getInstance()->setPermissions($api_pub_list, $role_id); // 更新 Casbin 权限
        }
        $update_data = [
            'role_id'      => $role_id,
            'menu_ids'     => $menu_ids,
            'menu_all_ids' => $menu_all_str,
            'api_ids'      => $api_ids
        ];
        // 保存
        $this->updateOrCreateRoleMenu($role_id, $update_data);

    }

    // 创建或更新数据
    public function updateOrCreateRoleMenu($role_id, $data)
    {
        return AdminRoleMenu::updateOrCreate(['role_id' => $role_id], $data);
    }
}
