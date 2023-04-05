<?php

use App\Helpers\Global\Constant;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Students\HomeController;
use App\Http\Controllers\Activities\PresenceController;


Route::middleware(['auth', 'role:' . Constant::STUDENT])->group(function () {
  Route::prefix('students')->name('students.')->group(function () {
    # Home
    Route::get('home', [HomeController::class, 'index'])->name('home');
  });

  # Presence menu
  Route::get('presences/{attendance}', [PresenceController::class, 'show'])->name('presences.show');
  Route::resource('presences', PresenceController::class)->except('show');
});
