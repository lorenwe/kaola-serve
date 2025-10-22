<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Rules\LanguageExists;
use App\Rules\SearchTimes;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Validator;

class LanguageRequest extends BaseRequest
{

    public function withValidator(Validator $validator)
    {
        // 设置未传参数默认值
        $validator->after(function ($validator) {
            $this->merge([
                'sort' => $this->sort ?? 0,
                'parent_id' => $this->parent_id ?? 0,
            ]);
        });
    }

    // 添加时的验证规则
    public function addRules()
    {
        $rules = [
            'name' => 'required',
            'zh-CN' => 'nullable|string',
            'en-US' => 'nullable|string',
            'ja-JP' => 'nullable|string',
            'zh-TW' => 'nullable|string',
            'sort' => 'nullable|integer'
        ];
        if ($this->has('parent_id')) {
            if ($this->input('parent_id') != 0) {
                $rules['parent_id'] = ['integer', new LanguageExists];
            }
        }

        return  $rules;
    }

    // 获取列表的验证规则
    public function listRules(){
        $rules = [
            'name' => 'nullable|string',
            'is_menu' => 'nullable|boolean',
            'start_time' => ['nullable', 'string', new SearchTimes],
            'end_time' => ['nullable', 'string', new SearchTimes],
        ];
        if ($this->has('start_time')) {
            $rules['end_time'] = array_merge($rules['end_time'], ['required_with:start_time']);
        }
        if ($this->has('end_time')) {
            $rules['start_time'] = array_merge($rules['start_time'], ['required_with:end_time']);
        }
        if ($this->has('start_time') && $this->has('end_time')) {
            $rules['end_time'] = array_merge($rules['end_time'], ['after:start_time']);
        }
        return $rules;
    }

    // 仅在更新操作时应用的验证规则
    public function idRules()
    {
        return [
            'id' => 'required',
        ];
    }

    // 动态返回应用规则
    public function getRules()
    {
        return match (Route::current()->uri) {
            'adm/language/edit' => array_merge($this->addRules(), $this->idRules()),
            'adm/language/del' => $this->idRules(),
            'adm/language/list' => array_merge($this->listRules()),
            'adm/language/add' => $this->addRules(),
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
//            'parent_id.integer' => '父级ID必须为整型',
//            'name.required' => '名称必填',
//            'zh-CN.required' => '中文必填',
//            'en-US.required' => '英文必填',
//            'ja-JP.required' => '日文必填',
//            'zh-TW.required' => '繁体必填',
//            'is_menu.boolean' => 'is_menu只能是布尔值',
//            'start_time.date_format' => '开始时间的格式不正确',
//            'end_time.date_format' => '结束时间的格式不正确',
//            'start_time.required_with' => '当提供结束时间时，必须提供开始时间',
//            'end_time.required_with' => '当提供开始时间时，必须提供结束时间',
//            'end_time.after' => "结束时间必须大于开始时间"
//        ], $this->pageMessages());
//    }
}
