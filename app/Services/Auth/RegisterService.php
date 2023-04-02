<?php

namespace App\Services\Auth;

use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Auth\RegisterRepository;
use App\Repositories\Educations\SchoolRepository;

class RegisterService
{
  public function __construct(
    protected RegisterRepository $repository,
    protected SchoolRepository $schoolRepository,
  ) {
    # code ...
  }

  public function getSchools()
  {
    DB::beginTransaction();
    try {
      $execute = $this->schoolRepository->getSchools();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }

  public function registered($request)
  {
    DB::beginTransaction();
    try {
      if ($request->file('avatar')) :
        $avatar = Storage::putFile('public/images/teachers', $request->file('avatar'));
      else :
        $avatar = null;
      endif;
      $execute = $this->repository->registered($request, $avatar);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }
}
