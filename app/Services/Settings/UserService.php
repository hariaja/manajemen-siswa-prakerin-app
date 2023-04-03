<?php

namespace App\Services\Settings;

use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Settings\UserRepository;

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

  public function edit($data, $request)
  {
    DB::beginTransaction();
    try {

      // Image management
      if ($request->file('avatar')) :
        if ($request->old_avatar) :
          Storage::delete($data->user->avatar);
        endif;
        $avatar = Storage::putFile('public/images/admin', $request->file('avatar'));
      else :
        $avatar = $data->user->avatar;
      endif;

      $execute = $this->userRepository->edit($data->id, $request, $avatar);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }
}
