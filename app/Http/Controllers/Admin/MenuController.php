<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuRequest;
use App\Models\Menu;

class MenuController extends Controller
{
    // 列表
    public function list(MenuRequest $request)
    {
        $search_param = $request->only(['menu_type', 'start_time', 'end_time', 'order_by', 'status', 'is_role']);
        $model = new Menu;
        if ($search_param['is_role']) {
            $model = $model->whereNull('redirect');
        }
        if (isset($search_param['menu_type'])) {
            $model = $model->where('menu_type', $search_param['menu_type']);
        }
        if (isset($search_param['status'])) {
            $model = $model->where('status', $search_param['status']);
        }
        if (isset($search_param['start_time'])) {
            $model = $model->whereBetween('create_at', [$search_param['start_time'], $search_param['end_time']]);
        }
        if (isset($search_param['order_by'])) {
            foreach ($search_param['order_by'] as $order_by) {
                $model = $model->orderBy($order_by[0], $order_by[1]);
            }
        }
        $field = ['menu.*', 'menu.id as name', 'menu.id as menu_id', 'language.zh-CN', 'language.en-US', 'language.ja-JP', 'language.zh-TW'];
        $list = $model->select($field)
            ->leftJoin('language', 'language.id', '=', 'menu.language_id')
            ->get()->toArray();
        foreach ($list as $key => $item) {
            if ($item['menu_api']) {
                $menu_apis = array_map('intval', explode(',', $item['menu_api']));
                $list[$key]['menu_api'] = $menu_apis;
            } else {
                $list[$key]['menu_api'] = [];
            }
        }
        $tree = buildTree($list);
        treeClearNullArr($tree);
        return $this->success($tree, __('messages.success'));
    }

    // 创建
    public function store(MenuRequest $request)
    {
        $username      = $request->get('username');
        $menu_api      = $request->input('menu_api');
        $field_arr     = ['language_id','parent_id', 'menu_type', 'component', 'path', 'icon', 'permission', 'sort', 'status', 'redirect',
            'target', 'layout', 'navTheme', 'headerTheme', 'fixSiderbar', 'fixedHeader', 'flatMenu', 'hideInMenu', 'hideChildrenInMenu',
            'hideInBreadcrumb', 'menuRender', 'menuHeaderRender', 'headerRender', 'footerRender'];
        if (!empty($menu_api)) {
            $menu_apis     = implode(',', $menu_api);
        } else {
            $menu_apis     = '';
        }
        $data = array_merge($request->only($field_arr), ['menu_api'=>$menu_apis, 'create_by'=>$username]);
        if (Menu::create($data)) {
            return $this->ok(__('messages.create_success'));
        } else {
            return $this->failed(__('messages.create_fail'));
        }
    }

    // 更新
    public function update(MenuRequest $request)
    {
        $id        = $request->input('id');
        $menu_api  = $request->input('menu_api');
        $username  = $request -> get('username');
        if (!empty($menu_api)) {
            $menu_apis     = implode(',', $menu_api);
        } else {
            $menu_apis     = '';
        }
        $menu = Menu::find($id);
        $field_arr     = ['language_id','parent_id', 'menu_type', 'component', 'path', 'icon', 'permission', 'sort', 'status', 'redirect',
            'target', 'layout', 'navTheme', 'headerTheme', 'fixSiderbar', 'fixedHeader', 'flatMenu', 'hideInMenu', 'hideChildrenInMenu',
            'hideInBreadcrumb', 'menuRender', 'menuHeaderRender', 'headerRender', 'footerRender'];
        $update_data = array_merge($request->only($field_arr), ['menu_api'=>$menu_apis, 'update_by'=>$username]);
        if ($menu && $menu->update($update_data)) {
            return $this->ok(__('messages.modify_success'));
        } else {
            return $this->failed(__('messages.modify_fail'));
        }
    }

    // 删除
    public function destroy(MenuRequest $request)
    {
        $input = $request->all();
        $username = $request -> get('username');
        $menu = Menu::find($input['id']);
        $update_data = ['update_by'=>$username,'delete_at'=> time()];
        if ($menu && $menu->update($update_data)) {
            return $this->ok(__('messages.delete_success'));
        } else {
            return $this->failed(__('messages.delete_fail'));
        }
    }
}
