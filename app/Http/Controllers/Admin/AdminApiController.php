<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminApiRequest;
use App\Models\AdminApi;

class AdminApiController extends Controller
{
    // 列表
    public function list(AdminApiRequest $request)
    {
        $page_param   = $request->only(['page_size', 'page']);
        $search_param = $request->only(['api_name', 'api_type', 'method', 'api_path', 'start_time', 'end_time', 'order_by', 'status']);
        $model = new AdminApi;
        if (isset($search_param['api_name'])) {
            $model = $model->where('api_name', 'like', '%'.$search_param['api_name'].'%');
        }
        if (isset($search_param['api_path'])) {
            $model = $model->where('api_path', 'like', '%'.$search_param['api_path'].'%');
        }
        if (isset($search_param['api_type'])) {
            $model = $model->where('api_type', $search_param['api_type']);
        }
        if (isset($search_param['method'])) {
            $model = $model->where('method', $search_param['method']);
        }
        if (isset($search_param['start_time'])) {
            $model = $model->whereBetween('create_at', [$search_param['start_time'], $search_param['end_time']]);
        }
        if (isset($search_param['order_by'])) {
            foreach ($search_param['order_by'] as $order_by) {
                $model = $model->orderBy($order_by[0], $order_by[1]);
            }
        }
        $field = ['*'];
        $list = $model->select($field)->get()->toArray();
        $tree = buildTree($list);
        treeClearNullArr($tree);
        return $this->success($tree, __('messages.success'));
    }

    // 创建
    public function store(AdminApiRequest $request)
    {
        $username      = $request -> get('username');
        $field_arr     = ['parent_id','api_name', 'api_type', 'api_path', 'method', 'sort', 'status'];
        $data          = array_merge($request->only($field_arr), ['create_by'=>$username]);
        $data          = AdminApi::create($data);
        if ($data) {
            return $this->ok(__('messages.create_success'));
        } else {
            return $this->failed(__('messages.create_fail'));
        }
    }

    // 更新
    public function update(AdminApiRequest $request)
    {
        $id          = $request->input('id');
        $username    = $request->get('username');
        $data        = AdminApi::find($id);
        $field_arr   = ['parent_id','api_name', 'api_type', 'api_path', 'method', 'sort', 'status'];
        $update_data = array_merge($request->only($field_arr), ['update_by'=>$username]);
        if ($data && $data->update($update_data)) {
            return $this->ok(__('messages.modify_success'));
        } else {
            return $this->failed(__('messages.modify_fail'));
        }
    }

    // 删除
    public function destroy(AdminApiRequest $request)
    {
        $id          = $request->input('id');
        $username    = $request->get('username');
        $data        = AdminApi::find($id);
        $update_data = ['delete_at'=> time(), 'update_by'=>$username];
        if ($data && $data->update($update_data)) {
            return $this->ok(__('messages.delete_success'));
        } else {
            return $this->failed(__('messages.delete_fail'));
        }
    }

    // 更新状态
    public function state(AdminApiRequest $request)
    {
        $id          = $request->input('id');
        $username    = $request->get('username');
        $data        = AdminApi::find($id);
        $field_arr   = ['status'];
        $update_data = array_merge($request->only($field_arr), ['update_by'=>$username]);
        if ($data && $data->update($update_data)) {
            return $this->ok(__('messages.modify_success'));
        } else {
            return $this->failed(__('messages.modify_fail'));
        }
    }
}
