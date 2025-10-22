<?php
namespace App\Services;

use Lauthz\Facades\Enforcer;

class AuthService extends BaseService
{
    public function getRoles($user_id)
    {
        $admin = AdminUserService::getInstance()->getUserById($user_id);
        return $admin->role_id;
    }

    public function checkPermission($role_id, $method, $route) :bool
    {
        $route = substr_replace($route,'',0,3); // 截掉路由的 adm 前缀
        if (Enforcer::enforce(AdminRoleService::getInstance()->getIdentifier($role_id), $route, $method)) {
            return true;
        } else {
            return false;
        }
    }
}
