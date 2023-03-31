<?php

namespace App\Repositories\Settings;

use App\Models\Role;
use App\Models\PermissionCategory;
use Illuminate\Database\Eloquent\Model;

class RoleRepository
{
  public function __construct(
    protected Role $role,
    protected PermissionCategory $permission
  ) {
    // 
  }

  public function query()
  {
    return $this->role->query();
  }

  public function store($data)
  {
    return $this->role->create([
      'name' => $data->name
    ])->syncPermissions($data->permission);
  }

  public function detail($id): Model
  {
    return $this->role->findOrFail($id);
  }

  public function update($id, $data)
  {
    $role = $this->detail($id);
    $role->updateOrFail([
      'name' => $data->name
    ]);
    return $role->syncPermissions($data->permission);
  }

  public function delete($id)
  {
    $role = $this->detail($id);
    return $role->delete();
  }

  public function roleHasPermission($id)
  {
    $role = $this->detail($id);
    return $role->permissions->pluck('name')->toArray();
  }

  public function permissions()
  {
    return $this->permission->with('permissions')->get();
  }
}
