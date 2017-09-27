<?php
use Illuminate\Routing\Router;

Route::group(['namespace' => '\App\Modules\Job'], function () {


    Route::any('jobsroot', ['as' => 'job.index', 'uses' => 'JobFrontController@getList']);

    Route::any('jobs/{mslug?}', ['as' => 'job.view', 'uses' => 'JobFrontController@getView'])->where('mslug', '(.*)');



    Route::group([
        'middleware' => config('admin.route.middleware'),
        'prefix'        => config('admin.route.prefix')
    ], function (Router $router) {

        // $router->get('job/{id}/clone', ['as' => 'admin.job.clone', 'uses' => 'JobAdminController@doClone']);
        // $router->get('job/search', ['as' => 'admin.job.search', 'uses' => 'JobAdminController@search']);

        $router->resource('jobs', JobAdminController::class);

    });

});