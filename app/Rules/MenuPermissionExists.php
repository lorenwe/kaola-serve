<?php

namespace App\Rules;

use App\Models\Menu;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MenuPermissionExists implements ValidationRule
{
    protected $menu_id;
    public function __construct($menu_id = null)
    {
        $this->menu_id = $menu_id;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // 自定义验证规则，验证 Menu 的父级id是否存在，存在则不通过
        if (is_null($this->menu_id)) {
            $res = Menu::where('permission', $value)->get();
        } else {
            $res = Menu::where('id', "<>", $this->menu_id)->where('permission', $value)->get();
        }

        if (!$res->isEmpty()) {
            // 结果为空
            $fail(__('messages.exist_permission'));
        }
    }
}
