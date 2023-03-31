<?php

namespace App\Http\Controllers\Settings;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\PermissionCategory;
use App\Http\Controllers\Controller;
use App\Services\Settings\RoleService;
use App\DataTables\Settings\RoleDataTable;
use App\Http\Requests\Settings\RoleRequest;

class RoleController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(protected RoleService $service)
  {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(RoleDataTable $dataTable)
  {
    return $dataTable->render('settings.roles.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $permissions = $this->service->permissions();
    return view('settings.roles.create', compact('permissions'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(RoleRequest $request)
  {
    $this->service->save($request);
    return redirect()->route('roles.index')->with('success', trans('session.create'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Role $role)
  {
    $permissions = $this->service->permissions();
    $rolePermissions = $this->service->roleHasPermission($role);
    return view('settings.roles.edit', compact('role', 'rolePermissions', 'permissions'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(RoleRequest $request, Role $role)
  {
    $this->service->update($role, $request);
    return redirect()->route('roles.index')->with('success', trans('session.update'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Role $role)
  {
    $this->service->destroy($role);
    return response()->json([
      'message' => trans('session.delete')
    ], 200);
  }
}
