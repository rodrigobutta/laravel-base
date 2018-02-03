<?php
use Illuminate\Routing\Router;

Route::group(['namespace' => '\App\Modules\Form'], function () {

    Route::get('form/{eventSlug}/{formSlug}', ['as' => 'forms.view', 'uses' => 'FormFrontController@getView']);
    // Route::get('forms/{formslug?}', ['as' => 'forms.view', 'uses' => 'FormFrontController@getView'])->where('formslug', '(.*)');
    Route::post('form/{eventSlug}/{formSlug}', ['as' => 'forms.view', 'uses' => 'FormFrontController@pushLead']);




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