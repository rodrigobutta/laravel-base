<?php
use Illuminate\Routing\Router;

Route::group(['namespace' => '\App\Modules\Campaign'], function () {

    // Route::any('campaignsroot', ['as' => 'campaign.index', 'uses' => 'CampaignFrontController@getList']);
    // Route::any('campaigns/{mslug?}', ['as' => 'campaign.view', 'uses' => 'CampaignFrontController@getView'])->where('mslug', '(.*)');

    Route::group([
        'middleware' => config('admin.route.middleware'),
        'prefix'        => config('admin.route.prefix')
    ], function (Router $router) {

        $router->resource('campaigns', CampaignAdminController::class);

    });

});