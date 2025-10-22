<?php
namespace App\Services;

use App\Models\Admin;
use Illuminate\Support\Facades\Cache;

class  AdminUserService extends BaseService
{
    /**根据id获取用户
     * @param $user_id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getUserById($user_id)
    {
        return Admin::query()->find($user_id);
    }

    /**根据用户名获取用户
     * @param $username
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getByUsername($username)
    {
        return Admin::query()
            ->where('username', $username)
            ->first();
    }


    /**根据token获取用户名
     * @param $token
     * @return string
     */
    public function getToken($token) {
        $username = Cache::get('login_key_'.$token);
        return $username;
    }

    /**根据token解密信息
     * @param $token
     * @return array|boolean
     */
    public function decryptToken($token) {
        $json_str = my_encrypt($token, "D", "mytoken");
        if (empty($json_str)) {
            return false;
        }
        $mid_data = json_decode($json_str, true);
        if(is_null($mid_data)) {
            return false;
        }
        return $mid_data;
    }

    /**
     * @param $data
     * @return string
     */
    public function creatToken($data) {
        $token = my_encrypt(json_encode([
            'id'=>$data['id'],
            'username'=>$data['username'],
            'role_id'=>$data['role_id'],
            'time'=>time()
        ]), "E", "mytoken");
        return $token;
    }

    /**刷新登入缓存。延后失效时间
     * @param $token
     * @return string
     */
    public function deferToken($token) {
        // 查看当前缓存设置时间
        $set_time = intval(Cache::get('login_key_time_'.$token));
        if((time() - $set_time) > 5400) {
            // 超过30分钟
            // 清除原来的缓存
            $username = $this->clearToken($token);
            // 保存新的token
            $this->saveToken($username, $token);
        }
    }

    /**保存登入信息
     * @param $id
     * @param $token
     */
    public function saveToken($id, $token) {
        Cache::put('login_key_time_'.$token, time(), 10800);  // 缓存设置时间
        Cache::put('login_key_'.$token, $id, 10800);
    }

    public function clearToken ($token) {
        $user_id = Cache::pull('login_key_'.$token);
        Cache::pull('login_key_time_'.$token);
        return $user_id;
    }
}
