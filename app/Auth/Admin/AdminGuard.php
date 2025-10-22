<?php
namespace App\Auth\Admin;

use App\Services\AdminUserService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Auth\Events\Attempting;
use Illuminate\Support\Facades\Hash;

class AdminGuard implements Guard
{
    use GuardHelpers;

    protected $user = null;
    protected $request;
    protected $provider;

    /**
     * 卫兵的名字。通常是“session”
     * 对应于身份验证配置中的保护名称
     * 这里是自定义后台守卫， 可以随意取名，但在配置文件中要与这里对应上
     * @var string
     */
    protected $name;

    /**
     * 事件调度程序实例
     * @var \Illuminate\Contracts\Events\Dispatcher
     */
    protected $events;

    /**
     * The current authorization token.
     *
     * @var string|null
     */
    public $token;

    /**
     * 请求提交验证的字段名称 如 token
     *
     * @var string
     */
    protected $inputKey;

    /**
     * 保存 token 的名称 如 后台token admin_token 前台token client_token
     *
     * @var string
     */
    protected $storageKey;

    /**
     * UserGuard constructor.
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @param UserProvider $provider
     * @param Request $request
     * @return void
     */
    public function __construct(Dispatcher $events, UserProvider $provider, Request $request = null)
    {
        $this->request    = $request;
        $this->provider   = $provider;
        $this->inputKey   = 'token';
        $this->storageKey = 'admin_token';
        $this->name       = 'admin';
        $this->events     = $events;
    }

    /**
     * 确定当前用户是否经过身份验证
     * @return bool
     */
    public function check(){
        $token = $this->getTokenForRequest();
        if(!empty($token)) {
            $user = $this->provider->retrieveByCredentials([$this->storageKey => $token]);
            if (is_null($user)) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * 确定当前用户是否为来宾
     * @return bool
     */
    public function guest(){
        $token = $this->getTokenForRequest();
        if(empty($token)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     *获取当前经过身份验证的用户。
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        if(!is_null($this->user)) {
            return $this->user;
        }
        $token = $this->getTokenForRequest();
        if(!empty($token)) {
            $user = $this->provider->retrieveByCredentials([$this->storageKey => $token]);
            if (is_null($user)) {
                return null;
            } else {
                $this->setUser($user);
                return $this->user;
            }
        } else {
            return null;
        }
    }

    /**
     * 获取当前经过身份验证的用户的ID
     * @return int|string|null
     */
    public function id()
    {
        if(!is_null($this->user())) {
            return $this->user()->getAuthIdentifier();
        } else {
            return null;
        }
    }

    /**
     * 验证用户的凭据
     * @param array $credentials
     * @return bool
     */
    public function validate(array $credentials = [])
    {
        if (empty($credentials[$this->inputKey])) {
            return false;
        }
        $credentials = [
            $this->storageKey => $credentials[$this->inputKey]
        ];
        $user = $this->provider->retrieveByCredentials($credentials);
        if (is_null($user)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 设置当前用户
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return void
     */
    public function setUser(Authenticatable $user)
    {
        $this->user = $user;
    }

    public function attempt(array $credentials = [], $remember = true)
    {
        // 查询数据库
        $user = AdminUserService::getInstance()->getByUsername($credentials['username']);
        if (is_null($user)) {
            return false;
        }
        if (!Hash::check($credentials['password'], $user->password)) {
            return false;
        }
        $admin = new Admin();
        $admin->mid_data   = $user->toArray();
        $this->setUser($admin);
        $this->fireAttemptEvent($credentials, $remember);
        $this->login($admin);
        return [
            'id'         => $user->id,
            'user_id'    => $user->id,
            'username'   => $user->username,
            'nickname'   => $user->nickname,
            'avatar'     => $user->avatar,
            'token'      => $this->token
        ];
    }

    public function checkPwd(array $credentials = [])
    {
        // 查询数据库
        $user = AdminUserService::getInstance()->getByUsername($credentials['username']);
        if (is_null($user)) {
            return false;
        }
        if (!Hash::check($credentials['password'], $user->password)) {
            return false;
        }
        return true;
    }

    /**
     * 获取事件调度程序实例
     * @return \Illuminate\Contracts\Events\Dispatcher
     */
    public function getDispatcher()
    {
        return $this->events;
    }

    /**
     * 设置事件调度程序实例
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function setDispatcher(Dispatcher $events)
    {
        $this->events = $events;
    }

    /**
     * 使用参数触发尝试事件.
     * @param  array  $credentials
     * @param  bool  $login
     * @return void
     */
    protected function fireAttemptEvent(array $credentials, $remember = false)
    {
        if (isset($this->events)) {
            $this->events->dispatch(new Attempting($this->name, $credentials, $remember));
        }
    }

    /**
     * 将用户登录到应用程序
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return void
     */
    public function login(Authenticatable $user)
    {
        $this->token = $this->generateAuthorizationToken();
        $this->fireLoginEvent($user);
    }

    /**
     * 如果设置了dispatcher，则触发登录事件
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return void
     */
    protected function fireLoginEvent($user)
    {

    }

    /**
     * 重置用户
     */
    public function resetUser()
    {
        $this->user = null;
    }

    /**
     * Log the user out of the application.
     *
     * @return void
     */
    public function logout()
    {
        $token = $this->getTokenForRequest();
        AdminUserService::getInstance()->clearToken($token);
        $this->resetUser();
    }

    /**
     * 获取当前请求的令牌
     * @return string
     */
    public function getTokenForRequest() {
        // 从 header 头中获取，或者从 input 中获取
        $token = $this->request->header($this->inputKey);
        if (is_null($token)) {
            $token = $this->request->input($this->inputKey);
        }
        $this->token = $token;
        return $token;
    }

    /**
     * 设置当前请求实例
     * @param \Illuminate\Http\Request $request
     * @return $this
     */
    public function setRequest(Request $request) {
        $this->request = $request;
        return $this;
    }

    /**
     * 生成随机唯一授权令牌
     * @return string
     */
    protected function generateAuthorizationToken()
    {
        $token = AdminUserService::getInstance()->creatToken($this->user->mid_data);
        AdminUserService::getInstance()->saveToken($this->user->getAuthIdentifier(), $token);
        return $token;
    }

}
