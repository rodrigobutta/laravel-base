<?php
use Illuminate\Routing\Router;

Route::group(['namespace' => '\App\Modules\Event'], function () {

    Route::group([
        'middleware' => config('admin.route.middleware'),
        'prefix'        => config('admin.route.prefix')
    ], function (Router $router) {

        // $router->resource('events', EventAdminController::class);

        $router->get('events', ['as' => 'events.root', 'uses' => 'EventAdminController@index']);
        $router->get('events/{itemId}', ['as' => 'events.manage', 'uses' => 'EventAdminController@manage']);

        $router->get('events/partials/create', ['as' => 'events.partials.create', 'uses' => 'EventAdminController@partialsCreate']);
        $router->post('events/partials/save', ['as' => 'events.partials.save', 'uses' => 'EventAdminController@partialsSave']);

    });

});