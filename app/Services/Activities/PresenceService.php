<?php

namespace App\Services\Activities;

use App\Repositories\Activities\PresenceRepository;
use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PresenceService
{
  public function __construct(protected PresenceRepository $presenceRepository)
  {
    # code...
  }

  public function getByStudent($attendance_id)
  {
    DB::beginTransaction();
    try {
      $execute = $this->presenceRepository->getByStudent($attendance_id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }

  public function isHasEnterToday($attendance_id)
  {
    DB::beginTransaction();
    try {
      $execute = $this->presenceRepository->isHasEnterToday($attendance_id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }

  public function isNotOutYet($attendance_id)
  {
    DB::beginTransaction();
    try {
      $execute = $this->presenceRepository->isNotOutYet($attendance_id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }
}
