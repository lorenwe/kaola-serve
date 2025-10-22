<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminUserRequest;
use App\Models\Admin;
use App\Services\AdminRoleService;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    // 列表
    public function list(AdminUserRequest $request)
    {
        $page_param   = $request->only(['page_size', 'page']);
        $search_param = $request->only(['nickname', 'sex', 'start_time', 'end_time', 'order_by', 'status']);
        $model = new Admin;
        if (isset($search_param['nickname'])) {
            $model = $model->where('nickname', 'like', '%'.$search_param['nickname'].'%');
        }
        if (isset($search_param['sex'])) {
            $model = $model->where('sex', $search_param['sex']);
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
        $field = ['admins.*'];
        $list = $model
            ->paginate($page_param['page_size'], $field, '', $page_param['page'])->toArray();
        foreach ($list['list'] as $key => $item) {
            $list['list'][$key]['city'] = [];
            $list['list'][$key]['tags'] = [];
            if ($item['city']) {
                $list['list'][$key]['city'] = explode(',', $item['city']);
            }
            if ($item['tags']) {
                $list['list'][$key]['tags'] = explode(',', $item['tags']);
            }
        }
        return $this->success($list, __('messages.success'));
    }

    // 创建
    public function store(AdminUserRequest $request)
    {
        $username      = $request->get('username');
        $password      = $request->input('password');
        $field_arr     = ['nickname','avatar', 'username', 'password', 'role_id', 'role_name',
            'sort', 'status', 'age', 'city', 'address', 'motto', 'phone', 'sex', 'tags'];
        $data             = array_merge($request->only($field_arr));
        $data['city']     = implode(',', $data['city']);
        $data['tags']     = implode(',', $data['tags']);
        $data['password'] = Hash::make($password);
        // 查询角色名称
        $role_info = AdminRoleService::getInstance()->getRoleInfoById($data['role_id']);
        $data['role_name'] = $role_info->role_name;
        $data          = Admin::create($data);
        if ($data) {
            return $this->ok(__('messages.create_success'));
        } else {
            return $this->failed(__('messages.create_fail'));
        }
    }

    // 更新
    public function update(AdminUserRequest $request)
    {
        $id          = $request->input('id');
        $username    = $request->get('username');
        $password    = $request->input('password');
        $data        = Admin::find($id);
        $field_arr   = ['nickname','avatar', 'username', 'role_id', 'role_name',
            'sort', 'status', 'age', 'city', 'address', 'motto', 'phone', 'sex', 'tags'];
        $update_data             = array_merge($request->only($field_arr));
        $update_data['city']     = implode(',', $update_data['city']);
        $update_data['tags']     = implode(',', $update_data['tags']);
        $update_data['password'] = Hash::make($password);
        // 查询角色名称
        $role_info = AdminRoleService::getInstance()->getRoleInfoById($update_data['role_id']);
        $update_data['role_name'] = $role_info->role_name;
        if ($data && $data->update($update_data)) {
            return $this->ok(__('messages.modify_success'));
        } else {
            return $this->failed(__('messages.modify_fail'));
        }
    }

    // 删除
    public function destroy(AdminUserRequest $request)
    {
        $id          = $request->input('id');
        $username    = $request->get('username');
        $data        = Admin::find($id);
        $update_data = ['delete_at'=> time()];
        if ($data && $data->update($update_data)) {
            return $this->ok(__('messages.delete_success'));
        } else {
            return $this->failed(__('messages.delete_fail'));
        }
    }

    // 更新状态
    public function state(AdminUserRequest $request)
    {
        $id          = $request->input('id');
        $username    = $request->get('username');
        $data        = Admin::find($id);
        $field_arr   = ['status'];
        $update_data = array_merge($request->only($field_arr));
        if ($data && $data->update($update_data)) {
            return $this->ok(__('messages.modify_success'));
        } else {
            return $this->failed(__('messages.modify_fail'));
        }
    }
}
