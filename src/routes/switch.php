<?php

use Illuminate\Support\Facades\Artisan;

Route::get('/SlothLab/Kill/{password}', function($password) {
    if($password == config('ziplock.token')) {
        Artisan::call('down --secret="' . config('ziplock.token') . '" --render="SlothUtilities::errors.404"');
        copy(base_path("routes/web.php"), base_path("storage/lock.dat"));
        $content = " ";
        if (file_put_contents(base_path('routes/web.php'), $content)) {
            return "Application is killed, use your password to navigate Example http://localhost:8000/slothadmin";
        } else {
            return "Somthing went wrong";
        }
    }
    else {
        return abort('404');
    }
})->name('switch.kill');

Route::get('/SlothLab/Revive/{password}', function ($password) {
    if ($password == config('ziplock.token')) {
        Artisan::call('up');
        if(!file_exists(base_path("storage/lock.dat")))
        {
            return "Oops! backup routes doesn't exist!";
        }
        if(copy(base_path("storage/lock.dat"), base_path("routes/web.php"))) {
            unlink(base_path("storage/lock.dat"));
            return "Application is up!";
        } else {
            return "Somthing went wrong";
        }

    }
    else {
        return abort('404');
    }
})->name('switch.revive');

