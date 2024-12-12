<?php

namespace YunusAsuroglu\BulkEmailler;

use Illuminate\Support\ServiceProvider;

class BulkEmailerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/bulk-emailer.php' => config_path('bulk-emailer.php'),
        ], 'bulk-emailer-config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/Config/bulk-emailer.php', 'bulk-emailer');
    
        // Sınıfı Service Container'a bağlama
        $this->app->singleton('bulk-emailer', function ($app) {
            return new \YunusAsuroglu\BulkEmailler\BulkEmailer();
        });
    
        $this->commands([
            \YunusAsuroglu\BulkEmailler\Console\Commands\SendBulkEmail::class,
        ]);
    }
}
