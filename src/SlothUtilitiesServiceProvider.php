<?php

namespace Slothlabdotcom\SlothUtilities;

use Illuminate\Support\ServiceProvider;
use Slothlabdotcom\SlothUtilities\Console\SlothInstall;

class SlothUtilitiesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/switch.php');
        $this->loadRoutesFrom(__DIR__ . '/routes/git.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'SlothUtilities');

        if ($this->app->runningInConsole()) {
            $this->commands([
                SlothInstall::class,
            ]);
            $this->publishes([
                __DIR__ . '/config/config.php' => config_path('ziplock.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/resources/assets' => public_path('sloth-assets'),
            ], 'assets');

        }

    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/config.php', 'ziplock');

    }
}
