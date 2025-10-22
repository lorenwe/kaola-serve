<?php

namespace App\Rules;

use App\Models\Menu;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MenuExists implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // 自定义验证规则，验证 Menu 的父级id是否存在，不存在则不通过
        $res = Menu::find($value);
        if (is_null($res)) {
            $fail(__('messages.missing_menu_id'));
        }
    }
}
