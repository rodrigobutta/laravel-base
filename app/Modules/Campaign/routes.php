<?php
use Illuminate\Routing\Router;

Route::group(['namespace' => '\App\Modules\Campaign'], function () {


    Route::any('campaign/pixel/{sendId}', ['as' => 'campaign.pixel', 'uses' => 'CampaignFrontController@getPixel']);


    Route::group([
        'middleware' => config('admin.route.middleware'),
        'prefix'        => config('admin.route.prefix')
    ], function (Router $router) {


        // $router->any('testmail', ['as' => 'mails.test', 'uses' => 'CampaignAdminController@testMail']);

        // $router->get('campaigns/create/{eventid}', ['as' => 'campaigns.createforevent', 'uses' => 'CampaignAdminController@createForEvent']);
        // $router->get('campaigns/create', ['as' => 'campaigns.createforevent', 'uses' => 'CampaignAdminController@createForEvent']);

        // $router->resource('campaigns', CampaignAdminController::class);


        $router->delete('campaigns/partials/{itemId}', ['as' => 'campaigns.partials.delete', 'uses' => 'CampaignAdminController@partialsDelete']);


        $router->get('campaigns/create/{eventId}/{typeId}', ['as' => 'campaigns.create', 'uses' => 'CampaignAdminController@create']);

        $router->get('campaigns/{itemId}/edit', ['as' => 'campaigns.edit', 'uses' => 'CampaignAdminController@edit']);
        $router->post('campaigns/save', ['as' => 'campaigns.save', 'uses' => 'CampaignAdminController@save']);

        $router->get('campaigns/{itemId}/config', ['as' => 'campaigns.config', 'uses' => 'CampaignAdminController@config']);
        $router->post('campaigns/config/save', ['as' => 'campaigns.config.save', 'uses' => 'CampaignAdminController@configSave']);
        $router->get('campaigns/{itemId}/process', ['as' => 'campaigns.process', 'uses' => 'CampaignAdminController@process']);

        $router->post('campaigns/{itemId}/process', ['as' => 'campaigns.process', 'uses' => 'CampaignAdminController@processMails']);
        $router->post('campaigns/{itemId}/process/test', ['as' => 'campaigns.process.test', 'uses' => 'CampaignAdminController@processTestMail']);

        $router->get('campaigns/{itemId}/details', ['as' => 'campaigns.details', 'uses' => 'CampaignAdminController@details']);
        $router->get('campaigns/{itemId}/view', ['as' => 'campaigns.view', 'uses' => 'CampaignAdminController@view']);

        $router->get('campaigns/{itemId}/clone', ['as' => 'campaigns.clone', 'uses' => 'CampaignAdminController@clone']);

        $router->get('campaigns/{itemId}/template', ['as' => 'campaigns.template', 'uses' => 'CampaignAdminController@template']);
        $router->post('campaigns/template', ['as' => 'campaigns.template', 'uses' => 'CampaignAdminController@templateSave']);
    });

});