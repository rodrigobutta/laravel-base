<?php
use Illuminate\Routing\Router;

Route::group(['namespace' => '\App\Modules\Lead'], function () {

    Route::get('leads/{formid}/export', ['as' => 'leads.export', 'uses' => 'LeadAdminController@export']);


    Route::group([
        'middleware' => config('admin.route.middleware'),
        'prefix'        => config('admin.route.prefix')
    ], function (Router $router) {

        $router->resource('leads', LeadAdminController::class);


        $router->get('leads/{formid}/export', ['as' => 'leads.export', 'uses' => 'LeadAdminController@export']);

    });

});