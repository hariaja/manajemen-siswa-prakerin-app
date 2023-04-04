<?php

namespace App\Services\Registrations;

use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Educations\SchoolRepository;
use App\Repositories\Educations\TeacherRepository;
use App\Repositories\Registrations\StudentRepository;

class StudentService
{
  public function __construct(
    protected StudentRepository $studentRepository,
    protected SchoolRepository $schoolRepository,
    protected TeacherRepository $teacherRepository,
  ) {
    # code...
  }

  public function check()
  {
    DB::beginTransaction();
    try {
      $execute = $this->studentRepository->checkingData();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }

  public function checkIfStudentRegistered()
  {
    DB::beginTransaction();
    try {
      $execute = $this->studentRepository->checkIfStudentRegistered();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
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

  public function getTeacherByUserId($teacher_id)
  {
    DB::beginTransaction();
    try {
      $execute = $this->teacherRepository->getDataByUserId($teacher_id);
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

      // Manage avatar
      if ($request->file('avatar')) :
        $avatar = Storage::putFile('public/images/students', $request->file('avatar'));
      else :
        $avatar = null;
      endif;

      // Eksekusi ke database via repo
      $execute = $this->studentRepository->save($request, $avatar);
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
        $avatar = Storage::putFile('public/images/students', $request->file('avatar'));
      else :
        $avatar = $data->user->avatar;
      endif;

      $execute = $this->studentRepository->edit($data->id, $request, $avatar);
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
      $execute = $this->studentRepository->delete($data->id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }
}
