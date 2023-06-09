<?php

use App\Helpers\Global\Constant;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Students\HomeController;
use App\Http\Controllers\Activities\ExcuseController;
use App\Http\Controllers\Students\PresenceController;


Route::middleware(['auth', 'role:' . Constant::STUDENT])->group(function () {
  Route::prefix('students')->name('students.')->group(function () {
    # Home
    Route::get('home', [HomeController::class, 'index'])->name('home');

    # Presence menu
    Route::get('presences/{attendance}', [PresenceController::class, 'show'])->name('presences.show');
    Route::post('presences/store/{attendance}', [PresenceController::class, 'store'])->name('presences.store');
    Route::post('presences/update/{attendance}', [PresenceController::class, 'update'])->name('presences.update');
    Route::resource('presences', PresenceController::class)->only('index');
  });

  # Excuse menu
  Route::get('excuses/create/{attendance}', [ExcuseController::class, 'create'])->name('excuses.create');
  Route::post('excuses/create/{attendance}', [ExcuseController::class, 'store'])->name('excuses.store');
});
