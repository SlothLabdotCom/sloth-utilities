<?php

namespace Slothlabdotcom\SlothUtilities;

use Illuminate\Support\ServiceProvider;


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
    }

    /**
     * Register the application services.
     */
    public function register()
    {

    }
}
