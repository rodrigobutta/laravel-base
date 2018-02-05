<?php
use Illuminate\Routing\Router;

Route::group(['namespace' => '\App\Modules\Lead'], function () {

    Route::get('leads/{formid}/export', ['as' => 'leads.export', 'uses' => 'LeadAdminController@export']);


    Route::group([
        'middleware' => config('admin.route.middleware'),
        'prefix'        => config('admin.route.prefix')
    ], function (Router $router) {

        $router->resource('leads', LeadAdminController::class);


        // $router->get('leads/{formid}/export', ['as' => 'leads.export', 'uses' => 'LeadAdminController@export']);

        $router->get('leadlist/{itemId}', ['as' => 'leadlist.manage', 'uses' => 'LeadAdminController@leadlistManage']);
        $router->get('leadlist/{itemId}/export', ['as' => 'leadlist.export', 'uses' => 'LeadAdminController@leadlistExport']);


        $router->delete('leadlist/batch/{itemId}/removeitem', ['as' => 'leadlist.batch.removeitem', 'uses' => 'LeadAdminController@leadlistBatchRemoveitem']);
    });

});