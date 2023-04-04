<?php

namespace App\Repositories\Master;

use App\Helpers\Global\Constant;
use App\Models\Leader;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class LeaderRepository
{
  public function __construct(protected Leader $leader)
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

    $user->assignRole(Constant::LEADER);

    return $this->leader->firstOrCreate([
      'user_id' => $user->id,
      'study_program_id' => $request->study_program_id,
      'nidn' => $request->nidn,
      'gender' => $request->gender,
    ]);
  }

  public function getDataById($id): Model
  {
    return $this->leader->findOrFail($id);
  }

  public function getDataByUserId($id): Model
  {
    return $this->leader->where('user_id', $id)->first();
  }

  public function edit($id, $request, $avatar)
  {
    $leader = $this->getDataById($id);
    $user = User::findOrFail($leader->user_id);

    $user->updateOrFail([
      'name' => $request->name,
      'email' => $request->email,
      'phone' => $request->phone,
      'avatar' => $avatar,
    ]);

    return $leader->updateOrFail([
      'nidn' => $request->nidn,
      'gender' => $request->gender,
    ]);
  }

  public function delete($id)
  {
    $leader = $this->getDataById($id);
    $user = User::findOrFail($leader->user_id);

    $user->delete();
    return $leader->delete();
  }
}
