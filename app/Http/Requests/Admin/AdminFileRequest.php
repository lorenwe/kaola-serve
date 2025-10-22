<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class AdminFileRequest extends FormRequest
{
    // 头像上传验证规则
    public function avatarRules()
    {
        $rules = [
            'file'       => 'required|image|mimes:jpeg,png,jpg,gif|size:2048', // 文件必须是图片，并且必须是 jpeg, png, jpg, gif 格式
        ];
        return  $rules;
    }

    // 动态返回应用规则
    public function getRules()
    {
        return match (Route::current()->uri) {
            'adm/admin/user/avatar' => $this->avatarRules(),
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
//        return [
//            'file.required' => '缺少文件',
//            'file.image' => '文件必须是图片',
//            'file.mimes' => '图片文件格式不正确',
//            'file.size' => '图片大小不得超过2M',
//        ];
//    }
}
