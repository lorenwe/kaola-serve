<?php
namespace App\Auth\Admin;

use App\Services\AdminUserService;
use Illuminate\Contracts\Auth\Authenticatable;
class Admin implements Authenticatable
{
    protected $primaryKey = 'id'; // 用户唯一标识，一般是主键
    public    $mid_data   = [];   // 用户的所有数据

    /** * 获取用户唯一标识的字段名称
     * @return string
     */
    public function getAuthIdentifierName() {
        return $this->primaryKey;
    }

    /** * 获取主键的值
     * @return mixed
     */
    public function getAuthIdentifier() {
        $id = $this->mid_data[$this->getAuthIdentifierName()];
        return $id;
    }

    public function getAuthPassword() {
        return '';
    }

    public function getRememberToken() {
        return '';
    }

    public function setRememberToken($value) {
        return true;
    }

    public function getRememberTokenName() {
        return '';
    }

    /** * 获取用户信息 (by id)
     * @param string $id
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public static function getUserById(string $id) {
        $user  = \App\Models\Admin::find($id);
        if ($user) {
            $admin = new Admin();
            $admin->mid_data = $user->toArray();
            return $admin;
        } else {
            return null;
        }
    }

    /** * 获取用户信息 (by token)
     * @param string $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public static function getUserByToken(string $token) {
        $mid_data = AdminUserService::getInstance()->decryptToken($token);
        // 验证是否失效
        if(is_null(AdminUserService::getInstance()->getToken($token))) {
            return null;
        }
        $admin = new Admin();
        $admin->mid_data = $mid_data;
        return $admin;
    }
}
