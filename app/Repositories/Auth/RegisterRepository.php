<?php

namespace App\Repositories\Auth;

use App\Models\User;
use App\Models\School;
use App\Helpers\Global\Constant;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class RegisterRepository
{
  public function __construct(protected User $model)
  {
    # code...
  }

  public function getSchools()
  {
    return School::orderBy('id', 'ASC')->get();
  }

  public function registered($request, $avatar)
  {
    $user = $this->model->firstOrCreate([
      'name' => $request->name,
      'email' => $request->email,
      'phone' => $request->phone,
      'password' => Hash::make($request->password),
      'status' => Constant::ACTIVE,
      'avatar' => $avatar,
    ]);

    $user->assignRole(Constant::TEACHER);

    Teacher::firstOrCreate([
      'user_id' => $user->id,
      'school_id' => $request->school_id,
      'gender' => $request->gender,
      'address' => $request->address,
    ]);

    return $user;
  }
}
