<?php



Route::get('/SlothLab/Kill/{password}', [SwitchController::class, 'kill'])->name('switch.kill');
Route::get('/SlothLab/Revive/{password}', [SwitchController::class, 'revive'])->name('switch.revive');

