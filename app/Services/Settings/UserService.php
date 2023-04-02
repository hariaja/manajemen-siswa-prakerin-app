<?php

namespace App\Services\Settings;

use App\Repositories\Settings\UserRepository;
use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserService
{
  public function __construct(protected UserRepository $userRepository)
  {
    # code...
  }

  public function status($user)
  {
    DB::beginTransaction();
    try {
      $execute = $this->userRepository->status($user->id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }
}
