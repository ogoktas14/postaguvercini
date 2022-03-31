<?php

namespace SerefErcelik\PostaGuvercini;

use Illuminate\Support\ServiceProvider;

class PostaGuverciniServiceProvider extends ServiceProvider
{

    protected $vendorName = "serefercelik";
    protected $packageName = "postaguvercini";

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/postaguvercini.php', 'postaguvercini');
        $this->app->bind('postaguvercini', function () {
            return new PostaGuvercini();
        });
    }

    /**
     * A list of artisan commands for your package.
     *
     * @var array
     */
    protected $commands = [

    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    protected function bootForConsole()
    {
        // Publishing the configuration file
        $this->publishes([
            __DIR__.'/../config/postaguvercini.php' => config_path('postaguvercini.php'),
        ], 'config');

    }


}
