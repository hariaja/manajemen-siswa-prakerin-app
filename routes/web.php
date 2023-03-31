<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Registrations\ScheduleController;
use App\Http\Controllers\Settings\RoleController;
use App\Http\Controllers\Settings\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
  return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'permission', 'verified'])->group(function () {
  # Setting menu
  Route::prefix('settings')->group(function () {
    # Role & permission
    Route::resource('roles', RoleController::class)->except('show');

    # User management
    Route::post('users/password', [UserController::class, 'password'])->name('users.password');
    Route::resource('users', UserController::class)->except('create', 'store');
  });

  # Schedule management
  Route::resource('schedules', ScheduleController::class)->except('show');
});
