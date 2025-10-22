<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 登录
    public function login(AuthRequest $request)
    {
        //接收数据
        $param       = $request->only(['username', 'password']);
        $credentials = ['username' => $param['username'], 'password' => $param['password']];
        $user_info = Auth::guard('admin')->attempt($credentials);
        if ($user_info) {
            return $this->success($user_info, __('messages.login_success'));
        }
        return $this->failed(__('messages.login_fail'));
    }

    // 登出
    public function logout()
    {
        Auth::guard('admin')->logout();
        return $this->ok(__('messages.logout_success'));
    }

    // 验证密码
    public function checkPwd(AuthRequest $request)
    {
        $username    = $request->get('username');
        $param       = $request->only(['password']);
        $credentials = ['username' => $username, 'password' => $param['password']];
        $boole = Auth::guard('admin')->checkPwd($credentials);
        if ($boole) {
            return $this->ok(__('messages.password_correct'));
        }
        return $this->failed(__('messages.password_error'));
    }
}
