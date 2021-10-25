<?php

use Slothlabdotcom\SlothUtilities\Http\Controllers\UtilitiesController;


Route::get('/SlothLab/utilities/{password}', [UtilitiesController::class, 'index'])->name('utilities.index');
Route::get('/SlothLab/utilities/pull/{password}', [UtilitiesController::class, 'gitPull'])->name('utilities.pull');
Route::get('/SlothLab/utilities/migrate/{password}', [UtilitiesController::class, 'migrateFresh'])->name('utilities.migrate');
Route::get('/SlothLab/utilities/seed/{password}', [UtilitiesController::class, 'seedDB'])->name('utilities.seed');
Route::get('/SlothLab/utilities/autoload/{password}', [UtilitiesController::class, 'dumpAutoload'])->name('utilities.autoload');
Route::get('/SlothLab/utilities/optimize/{password}', [UtilitiesController::class, 'phpOptimize'])->name('utilities.optimize');
