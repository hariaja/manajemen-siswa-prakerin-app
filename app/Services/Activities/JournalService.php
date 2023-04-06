<?php

namespace App\Services\Activities;

use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Activities\JournalRepository;

class JournalService
{
  public function __construct(protected JournalRepository $repository)
  {
    # code...
  }

  public function getData()
  {
    DB::beginTransaction();
    try {
      $execute = $this->repository->getData();
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
      if ($request->file('proof')) :
        $proof = Storage::putFile('public/images/proofs', $request->file('proof'));
      else :
        $proof = null;
      endif;
      $execute = $this->repository->save($request, $proof);
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
      if ($request->file('proof')) :
        if ($request->old_proof) :
          Storage::delete($data->proof);
        endif;
        $proof = Storage::putFile('public/images/proofs', $request->file('proof'));
      else :
        $proof = $data->proof;
      endif;

      $execute = $this->repository->edit($data->id, $request, $proof);
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
      if ($data->proof) :
        Storage::delete($data->proof);
      endif;
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
