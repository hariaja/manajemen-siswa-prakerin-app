<?php

namespace App\Services\Master;

use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Master\StudyProgramRepository;

class StudyProgramService
{
  public function __construct(protected StudyProgramRepository $repository)
  {
    # code...
  }

  public function all()
  {
    DB::beginTransaction();
    try {
      $execute = $this->repository->all();
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

  public function edit($data, $request)
  {
    DB::beginTransaction();
    try {
      $execute = $this->repository->edit($data->id, $request);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }

  public function delete($data)
  {
    DB::beginTransaction();
    try {
      $execute = $this->repository->delete($data->id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }
}
