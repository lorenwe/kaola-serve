<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Rules\LanguageExists;
use App\Rules\MenuExists;
use App\Rules\MenuPermissionExists;
use App\Rules\SearchTimes;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class MenuRequest extends BaseRequest
{

    public function withValidator(Validator $validator)
    {
        // 设置未传参数默认值
        $validator->after(function ($validator) {
            $this->merge([
                'sort'      => $this->sort ?? 0,
                'parent_id' => $this->parent_id ?? 0,
                'is_role'   => $this->is_role ?? false,
            ]);
            if ($this->menu_type === 'menu') {
                $this->merge([
                    'target' => $this->target ?? '_blank',
                    'layout' => $this->layout ?? 'side',
                    'navTheme' => $this->navTheme ?? 'light',
                    'headerTheme' => $this->headerTheme ?? 'light',
                ]);
            }
        });
    }

    // 添加时的验证规则
    public function addRules()
    {
        $rules = [
            'language_id' => ['required', 'integer', new LanguageExists],
            'menu_type'   => ['required', Rule::in(['dir', 'menu', 'button'])],
            'status'      => ['required', 'integer', Rule::in(['0', '1'])],
            'sort'        => ['nullable', 'integer'],
            'menu_api'    => ['nullable', 'array'],
        ];
        if (!$this->has('redirect')) {
            // 非重定向菜单permission参数必传
            $rules['permission'] = ['required', 'string', new MenuPermissionExists];
        }
        if ($this->has('parent_id')) {
            if ($this->input('parent_id') != 0) {
                $rules['parent_id'] = ['integer', new MenuExists];
            }
        }
        if ($this->has('target')) {
            $rules['target'] = ['string', Rule::in(['_blank', '_self', '_parent', '_top'])];
        }
        if ($this->has('layout')) {
            $rules['layout'] = ['string', Rule::in(['side', 'top', 'mix'])];
        }
        if ($this->has('navTheme')) {
            $rules['navTheme'] = ['string', Rule::in(['light', 'dark'])];
        }
        if ($this->has('headerTheme')) {
            $rules['headerTheme'] = ['string', Rule::in(['light', 'dark'])];
        }

        return  $rules;
    }

    // 编辑时的验证规则
    public function editRules()
    {
        $rules = [
            'language_id' => ['required', 'integer', new LanguageExists],
            'menu_type'   => ['required', Rule::in(['dir', 'menu', 'button'])],
            'status'      => ['required', 'integer', Rule::in(['0', '1'])],
            'sort'        => ['nullable', 'integer'],
            'menu_api'    => ['nullable', 'array'],
        ];
        if (!$this->has('redirect')) {
            // 非重定向菜单permission参数必传
            $rules['permission'] = ['required', 'string', new MenuPermissionExists($this->input('id'))];
        }
        if ($this->has('parent_id')) {
            if ($this->input('parent_id') != 0) {
                $rules['parent_id'] = ['integer', new MenuExists];
            }
        }
        if ($this->has('target')) {
            $rules['target'] = ['string', Rule::in(['_blank', '_self', '_parent', '_top'])];
        }
        if ($this->has('layout')) {
            $rules['layout'] = ['string', Rule::in(['side', 'top', 'mix'])];
        }
        if ($this->has('navTheme')) {
            $rules['navTheme'] = ['string', Rule::in(['light', 'dark'])];
        }
        if ($this->has('headerTheme')) {
            $rules['headerTheme'] = ['string', Rule::in(['light', 'dark'])];
        }

        return  $rules;
    }

    // 获取列表的验证规则
    public function listRules(){
        $rules = [
            'menu_type'   => ['nullable', 'string'],
            'status'      => ['nullable', 'integer', Rule::in(['0', '1'])],
            'start_time'  => ['nullable', 'string', new SearchTimes],
            'end_time'    => ['nullable', 'string', new SearchTimes],
            'is_role'     => ['nullable', 'boolean'],
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
            'adm/menu/edit' => array_merge($this->editRules(), $this->idRules()),
            'adm/menu/del' => $this->idRules(),
            'adm/menu/list' => array_merge($this->listRules()),
            'adm/menu/add' => $this->addRules(),
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
//            'language_id.required' => '名称必填',
//            'language_id.integer' => '名称必须关联国际化ID',
//            'menu_type.required' => '菜单类型必填',
//            'menu_type.in' => '菜单类型非有效值',
//            'status.required' => '状态必填',
//            'status.in' => '状态非有效值',
//            'target.string' => '窗口打开方式必须是字符串',
//            'target.in' => '窗口打开方式非有效值',
//            'layout.string' => 'layout布局必须是字符串',
//            'layout.in' => 'layout布局非有效值',
//            'navTheme.string' => '菜单主题必须是字符串',
//            'navTheme.in' => '菜单主题非有效值',
//            'headerTheme.string' => '顶部菜单主题必须是字符串',
//            'headerTheme.in' => '顶部菜单主题非有效值',
//            'permission.required' => '非重定向菜单权限标识必传',
//            'sort.integer' => '排序只能填写数字',
//            'menu_api.array' => '依赖接口需为数组结构'
//        ], $this->pageMessages(), $this->timeQueryMessages());
//    }
}
