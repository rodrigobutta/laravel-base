<?php
use Illuminate\Routing\Router;

Route::group(['namespace' => '\App\Modules\Tree'], function () {


    // Route::any('treesroot', ['as' => 'tree.index', 'uses' => 'TreeFrontController@getList']);
    // Route::any('trees/{mslug?}', ['as' => 'tree.view', 'uses' => 'TreeFrontController@getView'])->where('mslug', '(.*)');



    Route::group([
        'middleware' => config('admin.route.middleware'),
        'prefix'        => config('admin.route.prefix')
    ], function (Router $router) {

        $router->resource('trees', TreeAdminController::class);

    });

});