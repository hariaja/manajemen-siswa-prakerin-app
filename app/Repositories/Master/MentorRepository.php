<?php

namespace App\Repositories\Master;

use App\Models\User;
use App\Models\Mentor;
use App\Helpers\Global\Constant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class MentorRepository
{
  public function __construct(protected Mentor $mentor)
  {
    # code...
  }

  public function save($request, $avatar)
  {
    $user = User::firstOrCreate([
      'name' => $request->name,
      'email' => $request->email,
      'phone' => $request->phone,
      'password' => Hash::make('password'),
      'status' => Constant::ACTIVE,
      'avatar' => $avatar,
    ]);

    $user->assignRole(Constant::MENTOR);

    return $this->mentor->firstOrCreate([
      'user_id' => $user->id,
      'study_program_id' => $request->study_program_id,
      'gender' => $request->gender,
    ]);
  }

  public function getDataById($id): Model
  {
    return $this->mentor->findOrFail($id);
  }

  public function getDataByUserId($id): Model
  {
    return $this->mentor->where('user_id', $id)->first();
  }

  public function edit($id, $request, $avatar)
  {
    $mentor = $this->getDataById($id);
    $user = User::findOrFail($mentor->user_id);

    $user->updateOrFail([
      'name' => $request->name,
      'email' => $request->email,
      'phone' => $request->phone,
      'avatar' => $avatar,
    ]);

    return $mentor->updateOrFail([
      'gender' => $request->gender,
    ]);
  }

  public function delete($id)
  {
    $mentor = $this->getDataById($id);
    $user = User::findOrFail($mentor->user_id);

    $user->delete();
    return $mentor->delete();
  }
}
