<?php
use Illuminate\Routing\Router;

Route::group(['namespace' => '\App\Modules\Form'], function () {

    // los meto en este group para poder recuperar si esta autenticado o no y en base a eso ver si muestro el form y demas
    Route::group([
       'middleware'    => ['web'],
    ], function (Router $router) {

        $router->get('form/{eventSlug}/{formSlug}', ['as' => 'forms.view', 'uses' => 'FormFrontController@getView']);
        $router->post('form/{eventSlug}/{formSlug}', ['as' => 'forms.view', 'uses' => 'FormFrontController@pushLead']);

    });
    // Route::get('form/{eventSlug}/{formSlug}', ['as' => 'forms.view', 'uses' => 'FormFrontController@getView']);
    // Route::post('form/{eventSlug}/{formSlug}', ['as' => 'forms.view', 'uses' => 'FormFrontController@pushLead']);


    Route::group([
        'middleware' => config('admin.route.middleware'),
        'prefix'        => config('admin.route.prefix')
    ], function (Router $router) {

        $router->get('forms/{formid}/schema', ['as' => 'forms.schema', 'uses' => 'FormAdminController@schemaEditor']);
        $router->patch('forms/{formid}/schema', ['as' => 'forms.schema', 'uses' => 'FormAdminController@schemaUpdate']);

        $router->resource('forms', FormAdminController::class);


        $router->get('forms/{formid}/preview/{mail}', ['as' => 'forms.preview', 'uses' => 'FormAdminController@previewEmail']);

    });

});