<?php

namespace App\Repositories\Registrations;

use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Helpers\Global\Constant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class StudentRepository
{
  public function __construct(protected Student $student)
  {
    # code...
  }

  public function checkingData()
  {
    $user = me();
    $teacher = Teacher::where('user_id', $user->id)->first();

    return $this->student->where('school_id', $teacher->school_id)->get();
  }

  public function checkIfStudentRegistered()
  {
    return $this->student->whereNotIn('id', function ($query) {
      $query->select('student_id')->from('student_has_registrations');
    })->paginate(5);
  }

  public function save($request, $avatar)
  {
    $user = User::firstOrCreate([
      'name' => $request->name,
      'email' => $request->email,
      'phone' => $request->phone,
      'password' => Hash::make('password'),
      'status' => Constant::INACTIVE,
      'avatar' => $avatar,
    ]);

    $user->assignRole(Constant::STUDENT);

    return $this->student->firstOrCreate([
      'user_id' => $user->id,
      'school_id' => $request->school_id,
      'nisn' => $request->nisn,
      'major' => $request->major,
      'date_birth' => $request->date_birth,
      'gender' => $request->gender,
      'address' => $request->address,
    ]);
  }

  public function getDataById($id): Model
  {
    return $this->student->findOrFail($id);
  }

  public function edit($id, $request, $avatar)
  {
    $student = $this->getDataById($id);
    $user = User::findOrFail($student->user_id);

    $user->updateOrFail([
      'name' => $request->name,
      'email' => $request->email,
      'phone' => $request->phone,
      'avatar' => $avatar,
    ]);

    return $student->updateOrFail([
      'nisn' => $request->nisn,
      'date_birth' => $request->date_birth,
      'gender' => $request->gender,
      'major' => $request->major,
      'address' => $request->address,
    ]);
  }

  public function delete($id)
  {
    $student = $this->getDataById($id);
    $user = User::findOrFail($student->user_id);

    $user->delete();
    return $student->delete();
  }
}
