<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminFileRequest;
use App\Http\Requests\Admin\AdminUserRequest;
use App\Http\Requests\Admin\MenuRequest;
use App\Models\Admin;
use App\Models\Menu;
use App\Services\AdminRoleService;
use App\Services\FileUploadService;

// 公共接口控制器
class AdminPublicController extends Controller
{
    // 头像上传
    public function avatar(AdminFileRequest $request)
    {
        $file = $request->file('file');
        $data = FileUploadService::getInstance()->saveFile($file);
        return $this->success($data, __('messages.upload_success'));
    }

    // 获取登录用户基本信息
    public function info(AdminUserRequest $request)
    {
        $user_id     = $request->get('userid');
        $field_arr   = ['id','id as user_id','nickname','avatar','username','role_id','role_name','tags'];
        $data        = Admin::select($field_arr)->find($user_id)->toArray();
        $data['tags']= explode(',', $data['tags']);
        if ($data) {
            return $this->success($data, __('messages.success'));
        } else {
            return $this->failed(__('messages.failed'));
        }
    }

    // 获取用户权限标识
    public function permissions(MenuRequest $request)
    {
        $user_id     = $request->get('userid');
        $username    = $request->get('username');
        // 获取用户信息
        $field_arr   = ['id','id as user_id','nickname','avatar','username','role_id','role_name','tags'];
        $data        = Admin::select($field_arr)->find($user_id)->toArray();
        // 获取用户角色的菜单
        $role_menu = AdminRoleService::getInstance()->getRoleMenu($data['role_id']);
        $menu_all_id = array_map('intval', explode(',', $role_menu['menu_all_ids']));
        $model = new Menu;
        $field = ['menu.id','menu.parent_id','menu.path','menu.icon','menu.permission','hideInBreadcrumb',
            'menu.id as menu_id','language.name as name'];
        if ($username != 'lorenwe') {  // 超级管理员获取所有权限
            $model = $model->whereIn('menu.id', $menu_all_id);
        }
        $menu_list = $model->select($field)
            ->whereIn('menu.menu_type', ['button'])
            ->whereNull('menu.redirect')
            ->leftJoin('language', 'language.id', '=', 'menu.language_id')
            ->get()->toArray();
        $permissions = array_column($menu_list, 'permission');
        return $this->success($permissions, __('messages.success'));
    }

    // 获取用户菜单列表
    public function menu(MenuRequest $request)
    {
        $user_id     = $request->get('userid');
        // 获取用户信息
        $field_arr   = ['id','id as user_id','nickname','avatar','username','role_id','role_name','tags'];
        $data        = Admin::select($field_arr)->find($user_id)->toArray();
        // 获取用户角色的菜单
        $role_menu = AdminRoleService::getInstance()->getRoleMenu($data['role_id']);
        $menu_all_id = array_map('intval', explode(',', $role_menu['menu_all_ids']));
        $model = new Menu;
        // $field_arr     = ['language_id','parent_id', 'menu_type', 'component', 'path', 'icon', 'permission', 'sort', 'status', 'redirect',
        //     'target', 'layout', 'navTheme', 'headerTheme', 'fixSiderbar', 'fixedHeader', 'flatMenu', 'hideInMenu', 'hideChildrenInMenu',
        //     'hideInBreadcrumb', 'menuRender', 'menuHeaderRender', 'headerRender', 'footerRender'];
        $field = ['menu.id','menu.parent_id','menu.path','menu.icon','menu.permission','hideInBreadcrumb',
            'menu.id as menu_id','language.name as name'];
        $list = $model->select($field)
            ->whereIn('menu.menu_type', ['dir','menu'])
            ->whereIn('menu.id', $menu_all_id)
            ->whereNull('menu.redirect')
            ->leftJoin('language', 'language.id', '=', 'menu.language_id')
            ->get()->toArray();
        $tree = buildTree($list);
        treeClearNullArr($tree);
        return $this->success($tree, __('messages.success'));
    }
}
