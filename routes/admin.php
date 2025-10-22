<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\AuthController;
use \App\Http\Controllers\Admin\LanguageController;
use \App\Http\Controllers\Admin\MenuController;
use \App\Http\Controllers\Admin\AdminRoleController;
use \App\Http\Controllers\Admin\TestController;
use \App\Http\Controllers\Admin\AdminUserController;
use \App\Http\Controllers\Admin\AdminApiController;
use \App\Http\Controllers\Admin\AdminPublicController;
use LaravelLang\Locales\Facades\Locales;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/test', [TestController::class, 'orderBytest']);
Route::post('/language/allLocales', [LanguageController::class, 'allLocales']); // 获取翻译配置
Route::group(['middleware' => ['permission']], function () {
    Route::get('/test', function () {
        // dd(Locales::available());
        $default_locale = Locales::getDefault();
        Locales::set("zh_CN");
        dd($default_locale, Locales::getCurrent());
    });
    // 公共接口
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/check/pwd', [AuthController::class, 'checkPwd']);
    Route::post('/admin/user/info', [AdminPublicController::class, 'info']);               // 获取用户信息
    Route::post('/admin/user/menu', [AdminPublicController::class, 'menu']);               // 获取用户菜单列表
    Route::post('/admin/user/permissions', [AdminPublicController::class, 'permissions']); // 获取用户权限标识
    Route::post('/admin/user/avatar', [AdminPublicController::class, 'avatar']);           // 头像上传

    // 国际化
    Route::post('/language/add', [LanguageController::class, 'store']);
    Route::post('/language/edit', [LanguageController::class, 'update']);
    Route::post('/language/del', [LanguageController::class, 'destroy']);
    Route::post('/language/list', [LanguageController::class, 'list']);

    // 菜单管理
    Route::post('/menu/add', [MenuController::class, 'store']);
    Route::post('/menu/edit', [MenuController::class, 'update']);
    Route::post('/menu/del', [MenuController::class, 'destroy']);
    Route::post('/menu/list', [MenuController::class, 'list']);

    // 角色管理
    Route::post('/role/add', [AdminRoleController::class, 'store']);
    Route::post('/role/edit', [AdminRoleController::class, 'update']);
    Route::post('/role/del', [AdminRoleController::class, 'destroy']);
    Route::post('/role/list', [AdminRoleController::class, 'list']);
    Route::post('/role/state', [AdminRoleController::class, 'state']);

    // 后台用户管理
    Route::post('/admin/user/list', [AdminUserController::class, 'list']);
    Route::post('/admin/user/add', [AdminUserController::class, 'store']);
    Route::post('/admin/user/edit', [AdminUserController::class, 'update']);
    Route::post('/admin/user/del', [AdminUserController::class, 'destroy']);
    Route::post('/admin/user/state', [AdminUserController::class, 'state']);

    // 后台接口管理
    Route::post('/admin/api/list', [AdminApiController::class, 'list']);
    Route::post('/admin/api/add', [AdminApiController::class, 'store']);
    Route::post('/admin/api/edit', [AdminApiController::class, 'update']);
    Route::post('/admin/api/del', [AdminApiController::class, 'destroy']);
    Route::post('/admin/api/state', [AdminApiController::class, 'state']);

});

