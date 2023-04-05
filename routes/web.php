<?php

use App\Http\Controllers\Activities\AttendanceController;
use App\Http\Controllers\Activities\HolidayController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Master\LeaderController;
use App\Http\Controllers\Master\MentorController;
use App\Http\Controllers\Settings\RoleController;
use App\Http\Controllers\Settings\UserController;
use App\Http\Controllers\Educations\SchoolController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Educations\TeacherController;
use App\Http\Controllers\Master\StudyProgramController;
use App\Http\Controllers\Registrations\StudentController;
use App\Http\Controllers\Registrations\ScheduleController;
use App\Http\Controllers\Registrations\RegistrationController;
use App\Providers\RouteServiceProvider;

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
  return redirect(RouteServiceProvider::HOME);
});

Route::get('certificate', function () {
  return view('certificate');
});

Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

require __DIR__ . '/student.php';

Route::middleware(['auth', 'permission', 'verified'])->group(function () {
  # Setting menu
  Route::prefix('settings')->group(function () {
    # Role & permission
    Route::resource('roles', RoleController::class)->except('show');

    # User management password
    Route::get('users/password/{user}', [PasswordController::class, 'showChangePasswordForm'])->name('users.password');
    Route::post('users/password', [PasswordController::class, 'store']);

    # User management
    Route::patch('users/status/{user}', [UserController::class, 'status'])->name('users.status');
    Route::resource('users', UserController::class)->only('index', 'show', 'update');
  });

  # Schedule management
  Route::resource('schedules', ScheduleController::class);

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
    Route::resource('teachers', TeacherController::class)->except('create', 'store');
  });

  Route::prefix('regsitrations')->group(function () {
    # Student management
    Route::resource('students', StudentController::class);

    # Prakerin register
    Route::resource('registrations', RegistrationController::class)->except('edit');
  });

  Route::prefix('activities')->group(function () {
    # Holiday management
    Route::resource('holidays', HolidayController::class)->except('show');

    # Attendance management
    Route::resource('attendances', AttendanceController::class);
  });
});
