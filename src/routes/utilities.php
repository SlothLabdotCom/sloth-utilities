<?php

use Slothlabdotcom\SlothUtilities\Http\Controllers\UtilitiesController;




Route::get('/SlothLab/utilities/{password}', [UtilitiesController::class, 'index'])->name('utilities.index');
Route::get('/SlothLab/utilities/security/check/{password}', [UtilitiesController::class, 'check'])->name('utilities.check');

Route::get('/SlothLab/utilities/migrate/{password}', [UtilitiesController::class, 'migrateFresh'])->name('utilities.migrate');
Route::get('/SlothLab/utilities/seed/{password}', [UtilitiesController::class, 'seedDB'])->name('utilities.seed');
Route::get('/SlothLab/utilities/optimize/{password}', [UtilitiesController::class, 'phpOptimize'])->name('utilities.optimize');

Route::get('/SlothLab/utilities/security/scan/{password}', [UtilitiesController::class, 'scanChoice'])->name('utilities.choice');
Route::get('/SlothLab/utilities/security/malwarescan/{type}/{password}', [UtilitiesController::class, 'scan'])->name('utilities.scan');

