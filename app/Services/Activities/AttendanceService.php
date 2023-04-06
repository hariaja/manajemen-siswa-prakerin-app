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

  public function all()
  {
    DB::beginTransaction();
    try {
      $execute = $this->repository->getAll();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }

  public function getByStudyProdiIds($studyProgramId)
  {
    DB::beginTransaction();
    try {
      $execute = $this->repository->getByStudyProdiId($studyProgramId);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }

  public function getAttendancePresence($attendance_id)
  {
    DB::beginTransaction();
    try {
      $execute = $this->repository->getAttendancePresence($attendance_id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
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

  public function getById($attendance)
  {
    DB::beginTransaction();
    try {
      $execute = $this->repository->getById($attendance->id);
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
