<?php

namespace App\Services\Activities;

use App\Repositories\Activities\ExcuseRepository;
use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ExcuseService
{
  public function __construct(protected ExcuseRepository $excuseRepository)
  {
    # code...
  }

  public function getByDate($attendance_id)
  {
    DB::beginTransaction();
    try {
      $execute = $this->excuseRepository->getByDate($attendance_id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }

  public function isTherePermission($attendance_id)
  {
    DB::beginTransaction();
    try {
      $execute = $this->excuseRepository->isTherePermission($attendance_id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }

  public function save($request, $attendance_id)
  {
    DB::beginTransaction();
    try {
      $execute = $this->excuseRepository->save($request, $attendance_id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }

  public function update($excus, $request)
  {
    DB::beginTransaction();
    try {
      $execute = $this->excuseRepository->update($excus->id, $request);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }
}
