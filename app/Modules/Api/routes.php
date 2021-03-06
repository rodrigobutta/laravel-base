<?php
use Illuminate\Routing\Router;

Route::group(['namespace' => '\App\Modules\Api'], function () {

    Route::group([
      //  'middleware' => config('admin.route.middleware'),
        'middleware' => 'cors',
        'prefix'        => config('admin.route.prefix')
    ], function (Router $router) {

        // $router->any('api/usersbyrole', ['as' => 'api.usersbyrole', 'uses' => 'ApiAdminController@usersByRole']);
        $router->any('api/userlists', ['as' => 'api.userlists', 'uses' => 'ApiAdminController@userLists']);
        $router->any('api/userlisttypes', ['as' => 'api.userlisttypes', 'uses' => 'ApiAdminController@userListTypes']);
        $router->any('api/events', ['as' => 'api.events', 'uses' => 'ApiAdminController@events']);
        $router->any('api/formtypes', ['as' => 'api.formtypes', 'uses' => 'ApiAdminController@formTypes']);


        $router->post('api/upload/file', ['as' => 'api.upload.file', 'uses' => 'ApiAdminController@uploadFile']);

    });

});