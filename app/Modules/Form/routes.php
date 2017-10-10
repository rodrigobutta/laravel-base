<?php
use Illuminate\Routing\Router;

Route::group(['namespace' => '\App\Modules\Form'], function () {

    // Route::any('formsroot', ['as' => 'form.index', 'uses' => 'FormFrontController@getList']);
    Route::get('forms/{formslug?}', ['as' => 'form.view', 'uses' => 'FormFrontController@getView'])->where('formslug', '(.*)');
    Route::post('forms/{formslug?}', ['as' => 'form.view', 'uses' => 'FormFrontController@pushLead']);

    Route::group([
        'middleware' => config('admin.route.middleware'),
        'prefix'        => config('admin.route.prefix')
    ], function (Router $router) {

        $router->get('forms/{formid}/schema', ['as' => 'forms.schema', 'uses' => 'FormAdminController@schemaEditor']);
        $router->patch('forms/{formid}/schema', ['as' => 'forms.schema', 'uses' => 'FormAdminController@schemaUpdate']);

        $router->resource('forms', FormAdminController::class);

    });

});