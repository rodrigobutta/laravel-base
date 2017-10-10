<?php
use Illuminate\Routing\Router;

Route::group(['namespace' => '\App\Modules\Lead'], function () {


    Route::group([
        'middleware' => config('admin.route.middleware'),
        'prefix'        => config('admin.route.prefix')
    ], function (Router $router) {

        $router->resource('leads', LeadAdminController::class);

    });

});