<?php
use Illuminate\Routing\Router;

Route::group(['namespace' => '\App\Modules\User'], function () {

    // Route::any('usersroot', ['as' => 'user.index', 'uses' => 'UserFrontController@getList']);
    // Route::any('users/{mslug?}', ['as' => 'user.view', 'uses' => 'UserFrontController@getView'])->where('mslug', '(.*)');

    Route::group([
        'middleware' => config('admin.route.middleware'),
        'prefix'        => config('admin.route.prefix')
    ], function (Router $router) {

        $router->resource('users', UserAdminController::class);

    });

});