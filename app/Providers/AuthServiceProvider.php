<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Auth\Admin\AdminProvider;
use App\Auth\Admin\AdminGuard;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // 注册 auth 配置文件中的 admin-provider，在 auth 配置文件 providers 中
        // 自定义一个 provider 名称，这个 provider 的 driver 就是在这里注册的
        // 这个自定义 provider 的 model 可以在配置文件中直接指定
        Auth::provider('admin-provider', function() {
            return app(AdminProvider::class);
        });


        // 这里注册 auth 中的 guard, 注册后才能在 auth 配置文件中的 guards 配置中配置相关 guard
        // $app $name $config 参数就是创建自定义 Guard __construct中需要的参数
        Auth::extend('admin-driver', function($app, $name, array $config) {
            // dd($name, $config);
            if($name === 'admin') {
                return app()->make(AdminGuard::class, [
                    'events' => app('events'),
                    'provider' => Auth::createUserProvider($config['provider']),
                    'request' => $app->request,
                ]);
            }
            throw new \Exception('This guard only serves "auth:admin".');
        });
    }
}
