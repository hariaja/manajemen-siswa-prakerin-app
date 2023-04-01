<?php

namespace App\Repositories\Settings;

use App\Models\User;

class UserRepository
{
  public function __construct(protected User $user)
  {
    # code...
  }

  public function save()
  {
    return $this->user->firstOrCreate([
      // 
    ]);
  }
}
