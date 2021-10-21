<?php

use Slothlabdotcom\SlothUtilities\Http\Controllers\GitController;


Route::get('/SlothLab/git/{password}', [GitController::class, 'index'])->name('git.index');
