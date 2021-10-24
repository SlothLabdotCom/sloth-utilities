<?php

namespace Slothlabdotcom\SlothUtilities\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;


class SlothInstall extends Command
{
    protected $hidden = true;

    protected $signature = 'sloth:install';

    protected $description = 'Install Sloth Utilities';

    public function handle()
    {
        $this->info('Installing Sloth Utilities...');

        $password = "slothadmin";

        Artisan::call('cache:clear');
        Artisan::call('optimize');

        if (!$this->configExists('ziplock.php')) {
            $this->publishConfiguration();
            $this->publishAssets($force = true);
            $this->info('Published configuration');
        } else {
            if ($this->shouldOverwriteConfig()) {
                $this->info('Overwriting configuration file...');
                $this->publishConfiguration($force = true);
                $this->publishAssets($force = true);
            } else {
                $this->info('Existing configuration was not overwritten');
            }
        }

        shell_exec('php artisan optimize');
        shell_exec('php artisan cache:clear');
        shell_exec('php artisan view:clear');

        sleep(3);

        $this->line('Your password is: <fg=blue>'. $password .'</>');
        $this->info('You can change it in app/ziplock.php');
        $this->line('Use it as example: http://localhost:8000/SlothLab/git/<fg=blue>'. $password .'</>');

    }

    private function configExists($fileName)
    {
        return File::exists(config_path($fileName));
    }

    private function shouldOverwriteConfig()
    {
        return $this->confirm(
            'Config file already exists. Do you want to overwrite it?',
            false
        );
    }

    private function publishConfiguration($forcePublish = false)
    {
        $params = [
            '--provider' => "Slothlabdotcom\SlothUtilities\SlothUtilitiesServiceProvider",
            '--tag' => "config"
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);
    }

    private function publishAssets($forcePublish = false)
    {
        $params = [
            '--provider' => "Slothlabdotcom\SlothUtilities\SlothUtilitiesServiceProvider",
            '--tag' => "assets"
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);
    }

}
