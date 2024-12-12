<?php

namespace YunusAsuroglu\BulkEmailler;

use Illuminate\Support\ServiceProvider;

class BulkEmailerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/Views', 'bulk-emailer');

        $this->publishes([
            __DIR__ . '/Config/bulk-emailer.php' => config_path('bulk-emailer.php'),
        ], 'bulk-emailer-config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/Config/bulk-emailer.php', 'bulk-emailer');

        $this->commands([
            \YunusAsuroglu\BulkEmailler\Console\Commands\SendBulkEmail::class,
        ]);
    }
}
