<?php

namespace App\Services\Settings;

use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Settings\RoleRepository;

class RoleService
{
  public function __construct(protected RoleRepository $roleRepository)
  {
    # code...
  }

  public function save($request)
  {
    DB::beginTransaction();
    try {
      $execute = $this->roleRepository->store($request);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }

  public function update($role, $request)
  {
    DB::beginTransaction();
    try {
      $execute = $this->roleRepository->update($role->id, $request);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }

  public function destroy($role)
  {
    DB::beginTransaction();
    try {
      $execute = $this->roleRepository->delete($role->id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }

  public function roleHasPermission($role)
  {
    DB::beginTransaction();
    try {
      $execute = $this->roleRepository->roleHasPermission($role->id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }

  public function permissions()
  {
    DB::beginTransaction();
    try {
      $execute = $this->roleRepository->permissions();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }
}
