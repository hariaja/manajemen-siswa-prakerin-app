<?php

use App\Http\Controllers\Education\TeacherController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Master\LeaderController;
use App\Http\Controllers\Master\MentorController;
use App\Http\Controllers\Settings\RoleController;
use App\Http\Controllers\Settings\UserController;
use App\Http\Controllers\Educations\SchoolController;
use App\Http\Controllers\Master\StudyProgramController;
use App\Http\Controllers\Registrations\ScheduleController;

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

  Route::prefix('prodi')->group(function () {
    # Prodi management
    Route::resource('study-programs', StudyProgramController::class)
      ->parameters([
        'study-programs' => 'studyProgram',
      ])
      ->except('show');

    # Kaprodi management
    Route::resource('leaders', LeaderController::class);

    # Pembimbing management
    Route::resource('mentors', MentorController::class);
  });

  Route::prefix('educations')->group(function () {
    # School management
    Route::resource('schools', SchoolController::class)->except('show');

    # Teacher management
    Route::resource('teachers', TeacherController::class);
  });
});
