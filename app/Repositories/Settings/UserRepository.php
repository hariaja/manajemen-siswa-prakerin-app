<?php

namespace App\Repositories\Settings;

use App\Helpers\Global\Constant;
use App\Models\User;

class UserRepository
{
  public function __construct(protected User $user)
  {
    # code...
  }

  public function getDataById($id)
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
}
