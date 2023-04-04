<?php

namespace App\Repositories\Registrations;

use App\Models\User;
use App\Models\Registration;
use App\Helpers\Global\Constant;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
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
      'code' => AutoNumber('registrations', 'code', 'PG' . date('Ym'), 3, 5),
      'teacher_id' => $request->teacher_id,
      'schedule_id' => $request->schedule_id,
      'note' => $file,
      'register_date' => $request->date,
      'status' => Constant::PENDING,
    ]);

    $registration->students()->attach($request->student);
  }

  public function getDataById($id): Model
  {
    return $this->registration->findOrFail($id);
  }

  public function detailRegistration($id)
  {
    $registration = $this->getDataById($id);
    $datas = $registration->students;

    return datatables()->of($datas)
      ->addIndexColumn()
      ->addColumn('name', function ($row) {
        return $row->user->name;
      })
      ->addColumn('account', function ($row) {
        return $row->user->isStatus();
      })
      ->addColumn('school', function ($row) {
        return $row->school->name;
      })
      ->addColumn('major', function ($row) {
        return $row->major;
      })
      ->rawColumns(['account'])
      ->make(true);
  }

  public function editStatus($id, $request)
  {
    $registration = $this->getDataById($id);

    foreach ($registration->students as $student) {
      $user = User::findOrFail($student->user_id);
      $user->updateOrFail([
        'status' => Constant::ACTIVE,
      ]);
    }

    return $registration->updateOrFail([
      'study_program_id' => $request->study_program_id,
      'status' => $request->status,
    ]);
  }

  public function delete($id)
  {
    $registration = $this->getDataById($id);
    $student_id = $registration->students->pluck('id', 'id')->toArray();
    $registration->students()->detach($student_id);
    return $registration->delete();
  }
}
