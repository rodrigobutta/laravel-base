<?php
use Illuminate\Routing\Router;

Route::group(['namespace' => '\App\Modules\Job'], function () {


    Route::any('jobsroot', ['as' => 'job.index', 'uses' => 'JobFrontController@getList']);

    Route::any('jobs/{mslug?}', ['as' => 'job.view', 'uses' => 'JobFrontController@getView'])->where('mslug', '(.*)');



    Route::group([
        'middleware' => config('admin.route.middleware'),
        'prefix'        => config('admin.route.prefix')
    ], function (Router $router) {


        // $router->get('job', ['as' => 'admin.job.list', 'uses' => 'JobAdminController@getList']);
        // $router->post('job', ['as' => 'admin.job.put', 'uses' => 'JobAdminController@put']);
        // $router->post('job/reorder', ['as' => 'admin.job.reorder', 'uses' => 'JobAdminController@reorder']);
        // $router->patch('job/{id}/state', ['as' => 'admin.job.state', 'uses' => 'JobAdminController@state', 'before' => 'csrf']);
        // $router->get('job/{id}/edit', ['as' => 'admin.job.edit', 'uses' => 'JobAdminController@edit']);
        // $router->patch('job/{id}/edit', ['as' => 'admin.job.edit', 'uses' => 'JobAdminController@patch']);
        // $router->delete('job/{id}/edit', ['as' => 'admin.job.edit', 'uses' => 'JobAdminController@delete']);
        // $router->get('job/{id}/clone', ['as' => 'admin.job.clone', 'uses' => 'JobAdminController@doClone']);
        // $router->get('job/search', ['as' => 'admin.job.search', 'uses' => 'JobAdminController@search']);


        $router->resource('jobs', JobAdminController::class);

    });

});