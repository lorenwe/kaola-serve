<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class AdminUserRequest extends BaseRequest
{

    public function withValidator(Validator $validator)
    {
        // 设置可为空参数未传时的默认值
        $validator->after(function ($validator) {
            $this->merge([
                'sort'      => $this->sort ?? 0,
                // 'status'    => $this->status ?? 1,
            ]);
        });
    }

    // 设置验证之前参数默认值
    protected function prepareForValidation(): void
    {
        $this->merge([
            'page'      => $this->page ?? 1,
            'page_size' => $this->page_size ?? 10,
        ]);
    }

    // 添加时的验证规则
    public function addRules()
    {
        $rules = [
            'nickname'    => ['nullable', 'string'],
            'avatar'      => ['required', 'string'],
            'username'    => ['required', 'string'],
            'password'    => ['required', 'string'],
            'role_id'     => ['required', 'numeric'],
            'status'      => ['required', 'integer', Rule::in(['0', '1'])],
            'sort'        => ['nullable', 'integer'],
            'age'         => ['nullable', 'numeric'],
            'city'        => ['nullable', 'array'],
            'address'     => ['nullable', 'string'],
            'motto'       => ['nullable', 'string'],
            'phone'       => ['nullable', 'string'],
            'sex'         => ['nullable', 'string'],
            'tags'        => ['nullable', 'array'],

        ];
        return  $rules;
    }

    // 编辑时的验证规则
    public function editRules()
    {
        $rules = [
            'nickname'    => ['nullable', 'string'],
            'avatar'      => ['required', 'string'],
            'username'    => ['required', 'string'],
            'password'    => ['required', 'string'],
            'role_id'     => ['required', 'numeric'],
            'status'      => ['required', 'integer', Rule::in(['0', '1'])],
            'sort'        => ['nullable', 'integer'],
            'age'         => ['nullable', 'numeric'],
            'city'        => ['nullable', 'array'],
            'address'     => ['nullable', 'string'],
            'motto'       => ['nullable', 'string'],
            'phone'       => ['nullable', 'string'],
            'sex'         => ['nullable', 'string'],
            'tags'        => ['nullable', 'array'],
        ];
        return  $rules;
    }

    // 获取列表的验证规则
    public function listRules(){
        $rules = [
            'nickname'    => ['nullable', 'string'],
            'sex'         => ['nullable', 'string'],
            'status'      => ['nullable', 'integer', Rule::in(['0', '1'])],
        ];
        return $rules;
    }

    // 仅在更新操作时应用的验证规则
    public function idRules()
    {
        return [
            'id' => 'required',
        ];
    }

    // 更新状态操作的验证规则
    public function stateRules()
    {
        return [
            'status'      => ['required', 'integer', Rule::in(['0', '1'])],
        ];
    }

    // 动态返回应用规则
    public function getRules()
    {
        return match (Route::current()->uri) {
            'adm/admin/user/edit' => array_merge($this->editRules(), $this->idRules()),
            'adm/admin/user/del' => $this->idRules(),
            'adm/admin/user/list' => array_merge($this->listRules(), $this->timeQueryRules(), $this->pageRules()),
            'adm/admin/user/add' => $this->addRules(),
            'adm/admin/user/state' => array_merge($this->stateRules(), $this->idRules()),
            default => [],
        };
    }

    // 最终的验证规则
    public function rules()
    {
        return $this->getRules();
    }

//    public function messages()
//    {
//        return array_merge([
//            'id.required' => 'ID必填',
//            'status.in' => '状态非有效值',
//            'nickname.required' => '昵称必填',
//            'avatar.required' => '头像必填',
//            'username.required' => '用户名必填',
//            'password.required' => '密码必填',
//            'role_id.required' => '角色必填',
//            'sort.integer' => '排序只能填写数字',
//        ], $this->pageMessages(), $this->timeQueryMessages());
//    }
}
