<?php
use Illuminate\Routing\Router;

Route::group(['namespace' => '\App\Modules\UserField'], function () {

    // Route::any('userfieldsroot', ['as' => 'userfield.index', 'uses' => 'UserFieldFrontController@getList']);
    // Route::any('userfields/{mslug?}', ['as' => 'userfield.view', 'uses' => 'UserFieldFrontController@getView'])->where('mslug', '(.*)');

    Route::group([
        'middleware' => config('admin.route.middleware'),
        'prefix'        => config('admin.route.prefix')
    ], function (Router $router) {

        $router->resource('userfields', UserFieldAdminController::class);

    });

});