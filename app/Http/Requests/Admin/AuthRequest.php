<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use Illuminate\Support\Facades\Route;

class AuthRequest extends BaseRequest
{
    // 添加时的验证规则
    public function loginRules()
    {
        $rules = [
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
        return  $rules;
    }

    // 获取列表的验证规则
    public function checkPwdRules(){
        $rules = [
            'password' => ['required', 'string']
        ];
        return $rules;
    }

    // 动态返回应用规则
    public function getRules()
    {
        return match (Route::current()->uri) {
            'adm/login' => $this->loginRules(),
            'adm/check/pwd' => $this->checkPwdRules(),
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
//            'username.required' => '用户名称必填',
//            'username.string' => '用户名称必须为字符串',
//            'password.required' => '用户密码必填',
//            'password.string' => '用户密码必须为字符串',
//        ]);
//    }
}
