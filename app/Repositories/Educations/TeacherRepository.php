<?php

namespace App\Repositories\Educations;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class TeacherRepository
{
  public function __construct(protected Teacher $teacher)
  {
    # code...
  }

  public function all(): QueryBuilder
  {
    return $this->teacher->newQuery()
      ->whereHas('user', function ($row) {
        $row->orderBy('name', 'ASC');
      })->select('teachers.*');
  }

  public function getDataById($id): Model
  {
    return $this->teacher->findOrFail($id);
  }

  public function getDataByUserId($user_id): Model
  {
    return $this->teacher->where('user_id', $user_id)->first();
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
