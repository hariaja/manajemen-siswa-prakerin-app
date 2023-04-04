<?php

namespace App\Services\Registrations;

use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Registrations\ScheduleRepository;
use App\Repositories\Registrations\RegistrationRepository;

class RegistrationService
{
  public function __construct(
    protected RegistrationRepository $registrationRepository,
    protected ScheduleRepository $scheduleRepository,
  ) {
    # code...
  }

  public function scheduleOpen()
  {
    DB::beginTransaction();
    try {
      $execute = $this->scheduleRepository->scheduleOpen();
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

      // Image management
      if ($request->file('note')) :
        $note = Storage::putFile('public/pdf', $request->file('note'));
      else :
        $note = null;
      endif;

      $execute = $this->registrationRepository->save($request, $note);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }

  public function editStatus($data, $request)
  {
    DB::beginTransaction();
    try {
      $execute = $this->registrationRepository->editStatus($data->id, $request);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }

  public function details($data)
  {
    DB::beginTransaction();
    try {
      $execute = $this->registrationRepository->detailRegistration($data->id);
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
      if ($data->note) :
        Storage::delete($data->note);
      endif;
      $execute = $this->registrationRepository->delete($data->id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }
}
