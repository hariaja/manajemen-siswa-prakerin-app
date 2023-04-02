<?php

namespace App\Repositories\Educations;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Model;

class TeacherRepository
{
  public function __construct(protected Teacher $teacher)
  {
    # code...
  }

  public function getDataById($id): Model
  {
    return $this->teacher->findOrFail($id);
  }

  public function edit($id, $request, $avatar)
  {
    $teacher = $this->getDataById($id);
    $user = User::findOrFail($teacher->user_id);

    $user->updateOrFail([
      'name' => $request->name,
      'email' => $request->email,
      'phone' => $request->phone,
      'avatar' => $avatar,
    ]);

    return $teacher->updateOrFail([
      'school_id' => $request->school_id,
      'gender' => $request->gender,
      'address' => $request->address,
    ]);
  }

  public function delete($id)
  {
    $teacher = $this->getDataById($id);
    $user = User::findOrFail($teacher->user_id);

    $user->delete();
    return $teacher->delete();
  }
}
