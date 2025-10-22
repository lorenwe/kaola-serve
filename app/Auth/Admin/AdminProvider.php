<?php
namespace App\Auth\Admin;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider as Provider;

class AdminProvider implements Provider
{
    /**
     * 通过唯一标示符获取认证模型
     * @param mixed $identifier *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        return Admin::getUserById($identifier);
    }

    /**
     * 通过用户的唯一标识符和“记住我”获取认证模型
     * @param mixed $identifier
     * @param string $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
        // TODO api接口暂时不用记住我
        return null;
    }

    /**
     * 通过给定的认证模型更新 “记住我”令牌.
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @param string $token
     * @return bool
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        // TODO 暂时不更新
        return true;
    }

    /**
     * 通过给定的凭证获取用户，比如 email 或用户名等等
     * @param array $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        if ( !isset($credentials['admin_token'])) {
            return null;
        }
        return Admin::getUserByToken($credentials['admin_token']);
    }

    /**
     * 根据给定的凭据验证规则
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @param array $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        if (!isset($credentials['admin_token'])) {
            return false;
        }
        if (is_null($user)) {
            return false;
        }
        $admin_token = $credentials['admin_token'];
        $admin = Admin::getUserByToken($admin_token);
        if ($admin->getAuthIdentifier() != $user->getAuthIdentifier()) {
            return false;
        }
        return true;
    }

}
