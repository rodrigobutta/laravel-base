<?php
use Illuminate\Routing\Router;

Route::group(['namespace' => '\App\Modules\Form'], function () {

    // Route::any('formsroot', ['as' => 'form.index', 'uses' => 'FormFrontController@getList']);
    // Route::any('forms/{mslug?}', ['as' => 'form.view', 'uses' => 'FormFrontController@getView'])->where('mslug', '(.*)');

    Route::group([
        'middleware' => config('admin.route.middleware'),
        'prefix'        => config('admin.route.prefix')
    ], function (Router $router) {

        $router->any('testform', ['as' => 'mail.test', 'uses' => 'FormAdminController@testForm']);

        $router->resource('forms', FormAdminController::class);

    });

});