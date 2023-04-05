<?php

namespace App\Services\Master;

use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Master\MentorRepository;

class MentorService
{
  public function __construct(protected MentorRepository $repository)
  {
    # code...
  }

  public function all()
  {
    return $this->repository->all();
  }

  public function getByStudyProgramId()
  {
    return $this->repository->getByStudyProgramId();
  }

  public function save($request)
  {
    DB::beginTransaction();
    try {
      if ($request->file('avatar')) :
        $avatar = Storage::putFile('public/images/mentors', $request->file('avatar'));
      else :
        $avatar = null;
      endif;
      $execute = $this->repository->save($request, $avatar);
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
        $avatar = Storage::putFile('public/images/mentors', $request->file('avatar'));
      else :
        $avatar = $data->user->avatar;
      endif;

      $execute = $this->repository->edit($data->id, $request, $avatar);
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
      if ($data->user->avatar) :
        Storage::delete($data->user->avatar);
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
