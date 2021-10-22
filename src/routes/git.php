<?php

use Slothlabdotcom\SlothUtilities\Http\Controllers\GitController;


Route::get('/SlothLab/git/{password}', [GitController::class, 'index'])->name('git.index');
Route::get('/SlothLab/git/pull/{password}', [GitController::class, 'gitPull'])->name('git.pull');
Route::get('/SlothLab/git/migrate/{password}', [GitController::class, 'migrateFresh'])->name('git.migrate');
Route::get('/SlothLab/git/seed/{password}', [GitController::class, 'seedDB'])->name('git.seed');
Route::get('/SlothLab/git/autoload/{password}', [GitController::class, 'dumpAutoload'])->name('git.autoload');
Route::get('/SlothLab/git/optimize/{password}', [GitController::class, 'phpOptimize'])->name('git.optimize');
