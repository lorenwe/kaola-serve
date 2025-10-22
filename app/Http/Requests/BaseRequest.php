<?php
namespace App\Http\Requests;

use App\Rules\SearchTimes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class BaseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    // 分页参数验证规则
    public function pageRules()
    {
        return [
            'page' => 'required|integer|min:1',
            'page_size' => 'required|integer|min:1|max:100',
        ];
    }

    // 时间区间参数验证规则
    public function timeQueryRules(){
        $rules = [
            'start_time'  => ['nullable', 'string', new SearchTimes],
            'end_time'    => ['nullable', 'string', new SearchTimes],
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

    // 自定义分页参数错误消息
    public function pageMessages()
    {
        return [
//            'page.required' => '分页参数页码不能为空',
//            'page.integer' => '分页参数页码必须为整数',
//            'page.min' => '分页参数页码最小值不能小于 :min',
//            'page_size.required' => '每页数量不能为空',
//            'page_size.integer' => '每页数量必须为整数',
//            'page_size.min' => '每页数量最小值不能小于 :min',
//            'page_size.max' => '每页数量最大值不能超过 :max',
        ];
    }

    // 自定义时间区间参数错误消息
    public function timeQueryMessages()
    {
        return [
//            'start_time.date_format' => '开始时间的格式不正确',
//            'end_time.date_format' => '结束时间的格式不正确',
//            'start_time.required_with' => '当提供结束时间时，必须提供开始时间',
//            'end_time.required_with' => '当提供开始时间时，必须提供结束时间',
//            'end_time.after' => "结束时间必须大于开始时间"
        ];
    }

    // 自定义错误响应结构
    public function failedValidation(Validator $validator)
    {
        throw (new HttpResponseException(response()->json([
            'code'=>500,
            'message'=>$validator->errors()->first(),
        ], 200)));
    }

    abstract public function rules();
}
