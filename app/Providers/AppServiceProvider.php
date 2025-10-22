<?php

namespace App\Providers;

use App\Services\LengthAwarePaginatorService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // 自定义分页配置
        $this->app->bind('Illuminate\Pagination\LengthAwarePaginator',function ($app, $options){
            return new LengthAwarePaginatorService($options['items'], $options['total'], $options['perPage'], $options['currentPage'] , $options['options']);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
