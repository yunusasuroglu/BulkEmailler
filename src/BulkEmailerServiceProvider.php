<?php

namespace YunusAsuroglu\BulkEmailer;

use Illuminate\Support\ServiceProvider;

class BulkEmailerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Yönlendirme, görünümler ve yayınlama işlemleri
        $this->loadViewsFrom(__DIR__ . '/Views', 'bulk-emailer');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    
        $this->publishes([
            __DIR__ . '/Config/bulk-emailer.php' => config_path('bulk-emailer.php'),
        ], 'bulk-emailer-config');
    }
    
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/Config/bulk-emailer.php', 'bulk-emailer');
        $this->commands([
            \yunusasuroglu\BulkEmailer\Console\Commands\SendBulkEmail::class,
        ]);
    }
}
