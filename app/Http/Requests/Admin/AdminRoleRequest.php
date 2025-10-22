<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class AdminRoleRequest extends BaseRequest
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
            'role_name'   => ['required', 'string'],
            'role_code'   => ['required', 'string'],
            'status'      => ['required', 'integer', Rule::in(['0', '1'])],
            'sort'        => ['nullable', 'integer'],
            'describe'    => ['nullable', 'string'],
            'role_menu'   => ['required', 'array'],
        ];
        return  $rules;
    }

    // 编辑时的验证规则
    public function editRules()
    {
        $rules = [
            'role_name'   => ['required', 'string'],
            'role_code'   => ['required', 'string'],
            'status'      => ['required', 'integer', Rule::in(['0', '1'])],
            'sort'        => ['nullable', 'integer'],
            'describe'    => ['nullable', 'string'],
            'role_menu'   => ['required', 'array'],
        ];
        return  $rules;
    }

    // 获取列表的验证规则
    public function listRules(){
        $rules = [
            'role_name'   => ['nullable', 'string'],
            'role_code'   => ['nullable', 'string'],
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
            'adm/role/edit' => array_merge($this->editRules(), $this->idRules()),
            'adm/role/del' => $this->idRules(),
            'adm/role/list' => array_merge($this->listRules(), $this->timeQueryRules(), $this->pageRules()),
            'adm/role/add' => $this->addRules(),
            'adm/role/state' => array_merge($this->stateRules(), $this->idRules()),
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
//            'status.required' => '状态必填',
//            'status.in' => '状态非有效值',
//            'role_menu.required' => '菜单权限必填',
//            'sort.integer' => '排序只能填写数字',
//        ], $this->pageMessages(), $this->timeQueryMessages());
//    }
}
