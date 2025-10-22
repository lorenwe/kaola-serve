<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRoleRequest;
use App\Models\AdminRole;
use App\Services\AdminRoleMenuService;

class AdminRoleController extends Controller
{
    // 列表
    public function list(AdminRoleRequest $request)
    {
        $page_param   = $request->only(['page_size', 'page']);
        $search_param = $request->only(['role_name', 'role_code', 'start_time', 'end_time', 'order_by', 'status']);
        $model = new AdminRole;
        if (isset($search_param['role_name'])) {
            $model = $model->where('role_name', 'like', '%'.$search_param['role_name'].'%');
        }
        if (isset($search_param['role_code'])) {
            $model = $model->where('role_code', $search_param['role_code']);
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
        $field = ['admin_role.*','admin_role_menu.role_id','admin_role_menu.menu_ids','admin_role_menu.menu_all_ids','admin_role_menu.api_ids'];
        $list = $model
            ->leftJoin('admin_role_menu', 'admin_role_menu.role_id', '=', 'admin_role.id')
            ->paginate($page_param['page_size'], $field, '', $page_param['page'])->toArray();
        foreach ($list['list'] as $key => $item) {
            $list['list'][$key]['role_menu'] = [];
            if ($item['menu_ids']) {
                $list['list'][$key]['role_menu'] = explode(',', $item['menu_ids']);
            }
        }
        return $this->success($list, __('messages.success'));
    }

    // 创建
    public function store(AdminRoleRequest $request)
    {
        $username      = $request -> get('username');
        $role_menu     = $request->input('role_menu');
        $field_arr     = ['role_name','role_code', 'sort', 'status', 'describe'];
        $data          = array_merge($request->only($field_arr), ['create_by'=>$username]);
        $data          = AdminRole::create($data);
        if ($data) {
            // 更新角色菜单关联表
            AdminRoleMenuService::getInstance()->updateRoleMenu($data->id, $role_menu);
            return $this->ok(__('messages.create_success'));
        } else {
            return $this->failed(__('messages.create_fail'));
        }
    }

    // 更新
    public function update(AdminRoleRequest $request)
    {
        $id          = $request->input('id');
        $role_menu   = $request->input('role_menu');
        $username    = $request->get('username');
        $role        = AdminRole::find($id);
        $field_arr   = ['role_name','role_code', 'sort', 'status', 'describe'];
        $update_data = array_merge($request->only($field_arr), ['update_by'=>$username]);
        if ($role && $role->update($update_data)) {
            AdminRoleMenuService::getInstance()->updateRoleMenu($id, $role_menu);
            return $this->ok(__('messages.modify_success'));
        } else {
            return $this->failed(__('messages.modify_fail'));
        }
    }

    // 更新状态
    public function state(AdminRoleRequest $request)
    {
        $id          = $request->input('id');
        $username    = $request->get('username');
        $role        = AdminRole::find($id);
        $field_arr   = ['status'];
        $update_data = array_merge($request->only($field_arr), ['update_by'=>$username]);
        if ($role && $role->update($update_data)) {
            return $this->ok(__('messages.modify_success'));
        } else {
            return $this->failed(__('messages.modify_fail'));
        }
    }

    // 删除
    public function destroy(AdminRoleRequest $request)
    {
        $id          = $request->input('id');
        $username    = $request->get('username');
        $role        = AdminRole::find($id);
        $update_data = ['update_by'=>$username,'delete_at'=> time()];
        if ($role && $role->update($update_data)) {
            return $this->ok(__('messages.delete_success'));
        } else {
            return $this->failed(__('messages.delete_fail'));
        }
    }
}
