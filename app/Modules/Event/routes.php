<?php
use Illuminate\Routing\Router;

Route::group(['namespace' => '\App\Modules\Event'], function () {

    Route::group([
        'middleware' => config('admin.route.middleware'),
        'prefix'        => config('admin.route.prefix')
    ], function (Router $router) {

        $router->get('events/{eventid}/manage', ['as' => 'events.manage', 'uses' => 'EventAdminController@manage']);

        $router->resource('events', EventAdminController::class);

    });

});