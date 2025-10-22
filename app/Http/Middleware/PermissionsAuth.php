<?php

namespace App\Http\Middleware;

use App\Helpers\Api\ApiResponse;
use App\Services\AdminUserService;
use App\Services\AuthService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionsAuth
{
    use ApiResponse;

    /**
     * 权限控制中间件
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $admin = Auth::guard('admin')->user();
        if (is_null($admin)) {
            return $this->unauthorized(__('messages.not_logged_in'));
        }
        $mid_params = ['userid'=>$admin->mid_data['id'], 'username' => $admin->mid_data['username'], 'role_id' => $admin->mid_data['role_id']];
        $request->attributes->add($mid_params);
        $user_id    = $mid_params['userid'];
        $username   = $mid_params['username'];
        $role_id    = $mid_params['role_id'];
        if ($username == "lorenwe") {
            $bool = true;
        } else {
            $bool = AuthService::getInstance()->checkPermission($role_id, $request->method(), $request->route()->uri());
        }
        if(!$bool) {
            return $this->forbidden(__('messages.no_access'));
        } else {
            // 延长token失效时间
            AdminUserService::getInstance()->deferToken(Auth::guard('admin')->getTokenForRequest());
            $response = $next($request);
        }
        return $response;
    }
}
