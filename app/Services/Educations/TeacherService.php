<?php

namespace App\Services\Educations;

use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Educations\SchoolRepository;
use App\Repositories\Educations\TeacherRepository;

class TeacherService
{
  public function __construct(
    protected SchoolRepository $schoolRepository,
    protected TeacherRepository $teacherRepository,
  ) {
    # code...
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

  public function edit($data, $request)
  {
    DB::beginTransaction();
    try {

      // Image management
      if ($request->file('avatar')) :
        if ($request->old_avatar) :
          Storage::delete($data->user->avatar);
        endif;
        $avatar = Storage::putFile('public/images/teachers', $request->file('avatar'));
      else :
        $avatar = $data->user->avatar;
      endif;

      $execute = $this->teacherRepository->edit($data->id, $request, $avatar);
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
      $execute = $this->teacherRepository->delete($data->id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }
}
