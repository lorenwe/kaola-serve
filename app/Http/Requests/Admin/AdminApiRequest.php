<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class AdminApiRequest extends BaseRequest
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
            'api_name'    => ['required', 'string'],
            'api_path'    => ['nullable', 'string'],
            'method'      => ['nullable', 'string'],
            'status'      => ['required', 'integer', Rule::in(['0', '1'])],
            'api_type'    => ['required', 'string', Rule::in(['dir', 'api'])],
            'sort'        => ['nullable', 'integer'],
        ];
        return  $rules;
    }

    // 编辑时的验证规则
    public function editRules()
    {
        $rules = [
            'api_name'    => ['required', 'string'],
            'api_path'    => ['nullable', 'string'],
            'method'      => ['nullable', 'string'],
            'status'      => ['required', 'integer', Rule::in(['0', '1'])],
            'api_type'    => ['required', 'string', Rule::in(['dir', 'api'])],
            'sort'        => ['nullable', 'integer'],
        ];
        return  $rules;
    }

    // 获取列表的验证规则
    public function listRules(){
        $rules = [
            'api_name'    => ['nullable', 'string'],
            'api_path'    => ['nullable', 'string'],
            'method'      => ['nullable', 'string'],
            'api_type'    => ['nullable', 'string'],
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
            'adm/admin/api/edit' => array_merge($this->editRules(), $this->idRules()),
            'adm/admin/api/del' => $this->idRules(),
            'adm/admin/api/list' => array_merge($this->listRules(), $this->timeQueryRules(), $this->pageRules()),
            'adm/admin/api/add' => $this->addRules(),
            'adm/admin/api/state' => array_merge($this->stateRules(), $this->idRules()),
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
//            'id.required'       => 'ID必填',
//            'status.in'         => '状态非有效值',
//            'status.required'   => '状态必填',
//            'api_type.required' => '类型必填',
//            'api_type.in'       => '类型非有效值',
//            'api_name.required' => '接口名称必填',
//            'api_path.required' => '接口地址必填',
//            'method.required'   => '请求方式必填',
//            'sort.integer'      => '排序只能填写数字',
//        ], $this->pageMessages(), $this->timeQueryMessages());
//    }
}
