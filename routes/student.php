<?php

use App\Helpers\Global\Constant;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Students\HomeController;


Route::middleware(['auth', 'role:' . Constant::STUDENT])->group(function () {
  Route::prefix('students')->name('students.')->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
  });
});
