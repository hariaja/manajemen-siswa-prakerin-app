<?php

namespace App\Repositories\Registrations;

use App\Models\User;
use App\Models\Registration;
use App\Helpers\Global\Constant;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class RegistrationRepository
{
  public function __construct(protected Registration $registration)
  {
    # code...
  }

  public function save($request, $file)
  {
    // Add to registrations models
    $registration = $this->registration->firstOrCreate([
      'code' => AutoNumber('registrations', 'code', 'PG' . date('Ym'), 3, 9),
      'teacher_id' => $request->teacher_id,
      'schedule_id' => $request->schedule_id,
      'note' => $file,
      'date' => $request->date,
      'status' => Constant::PENDING,
    ]);

    // Add to users tables
    foreach ($request->name as $key => $value) :
      $user = User::firstOrCreate([
        'name' => $value,
        'email' => $request->email[$key],
        'phone' => $request->phone[$key],
        'password' => Hash::make('password'),
        'status' => Constant::INACTIVE,
      ]);

      $user->assignRole(Constant::STUDENT);

      Student::firstOrCreate([
        'user_id' => $user->id,
        'school_id' => $request->school_id,
        'registration_id' => $registration->id,
        'nisn' => $request->nisn[$key],
        'class' => $request->class[$key],
        'date_birth' => $request->date_birth[$key],
        // 'address' => $request->address[$key],
        'gender' => $request->gender[$key],
        'address' => 'Ini Test',
      ]);
    endforeach;

    return $registration;
  }
}
