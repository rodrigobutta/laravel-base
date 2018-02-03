<?php
namespace App\Modules\Api;

use Illuminate\Support\ServiceProvider;


class ApiServiceProvider extends ServiceProvider {

    protected $packageName = 'api';


    public function boot()
    {
        include __DIR__.'/routes.php';

        // Publish your config
        $this->publishes([
            __DIR__.'/config/config.php' => config_path($this->packageName.'.php'),
        ], 'config');


    }


    public function register()
    {
        $this->mergeConfigFrom( __DIR__.'/config/config.php', $this->packageName);

    }

}
