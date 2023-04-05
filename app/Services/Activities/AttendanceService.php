<?php

namespace App\Services\Activities;

use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Activities\AttendanceRepository;

class AttendanceService
{
  public function __construct(protected AttendanceRepository $repository)
  {
    # code...
  }

  public function count()
  {
    DB::beginTransaction();
    try {
      $execute = $this->repository->count();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }

  public function save($request)
  {
    DB::beginTransaction();
    try {
      $execute = $this->repository->save($request);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }

  public function edit($attendance, $request)
  {
    DB::beginTransaction();
    try {
      $execute = $this->repository->edit($attendance->id, $request);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }

  public function delete($attendance)
  {
    DB::beginTransaction();
    try {
      $execute = $this->repository->delete($attendance->id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }
}
