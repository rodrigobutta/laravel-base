<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Schema::defaultStringLength(191);

        // reb cambio el idioma en base a la configuracion de la tabla settings
        \Config::set('app.locale', siteSettings('locale'));

        app()->setLocale(\Config::get('app.locale'));
        setlocale(LC_TIME, \Config::get('app.locale'));
        \Carbon\Carbon::setLocale(\Config::get('app.locale'));
        \Carbon\Carbon::setUtf8(true);

        \Carbon\Carbon::setWeekStartsAt(\Carbon\Carbon::SUNDAY);
        \Carbon\Carbon::setWeekEndsAt(\Carbon\Carbon::SATURDAY);

        // https://github.com/rappasoft/laravel-5-boilerplate/issues/211

        // reb cambio el UTM en base a la configuracion de la tabla settings
        \Config::set('app.timezone', siteSettings('timezone'));
        date_default_timezone_set(\Config::get('app.timezone'));


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //

        $this->app->bind('mailgun.client', function() {
            return \Http\Adapter\Guzzle6\Client::createWithConfig([
                'verify' => false,
                'timeout' => 5
            ]);
        });


    }
}
