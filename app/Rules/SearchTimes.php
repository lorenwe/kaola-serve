<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SearchTimes implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // 自定义验证规则，验证时间格式是否符合规范
        if (!validateTimeFormat($value)) {
            $fail(__('messages.incorrect_time_format'));
        }
    }
}
