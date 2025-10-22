<?php

namespace App\Rules;

use App\Models\Language;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class LanguageExists implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // 自定义验证规则，验证 Language 的父级id是否存在，不存在则不通过
        $res = Language::find($value);
        if (is_null($res)) {
            $fail(__('messages.missing_local_id'));
        }
    }
}
