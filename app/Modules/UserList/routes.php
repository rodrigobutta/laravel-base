<?php
use Illuminate\Routing\Router;

Route::group(['namespace' => '\App\Modules\UserList'], function () {

    Route::group([
        'middleware' => config('admin.route.middleware'),
        'prefix'        => config('admin.route.prefix')
    ], function (Router $router) {

        $router->resource('userlists', UserListAdminController::class);

    });

});