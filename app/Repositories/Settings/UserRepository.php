<?php

namespace App\Repositories\Settings;

use App\Models\User;
use App\Helpers\Global\Constant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class UserRepository
{
  public function __construct(protected User $user)
  {
    # code...
  }

  public function getDataById($id): Model
  {
    return $this->user->findOrFail($id);
  }

  public function status($id)
  {
    $user = $this->getDataById($id);

    if ($user->status == Constant::ACTIVE) :
      $user->updateOrFail([
        'status' => Constant::INACTIVE,
      ]);
    else :
      $user->updateOrFail([
        'status' => Constant::ACTIVE,
      ]);
    endif;

    return $user;
  }

  public function edit($id, $request, $avatar)
  {
    $user = $this->getDataById($id);
    $user->updateOrFail([
      'name' => $request->name,
      'email' => $request->email,
      'phone' => $request->phone,
      'avatar' => $avatar,
    ]);

    return $user;
  }
}
