<?php

namespace Database\Seeders;

use App\Helpers\Global\Constant;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // reset cahced roles and permission
    app()[PermissionRegistrar::class]->forgetCachedPermissions();

    // Role Name
    $datas = [
      'Administrator',
      'Leader',
      'Teacher',
      'Mentor',
      'Student',
    ];

    foreach ($datas as $data) {
      $roles = Role::create([
        'name' => $data,
        'guard_name' => 'web'
      ]);
    }

    $leader = $roles->where('name', Constant::LEADER)->first();
    $leader->syncPermissions(
      Permission::where('name', 'LIKE', 'users.show')
        ->orWhere('name', 'LIKE', 'users.update')
        ->get()
    );

    $teacher = $roles->where('name', Constant::TEACHER)->first();
    $teacher->syncPermissions(
      Permission::where('name', 'LIKE', 'users.show')
        ->orWhere('name', 'LIKE', 'users.update')
        ->get()
    );

    $mentor = $roles->where('name', Constant::MENTOR)->first();
    $mentor->syncPermissions(
      Permission::where('name', 'LIKE', 'users.show')
        ->orWhere('name', 'LIKE', 'users.update')
        ->get()
    );

    $student = $roles->where('name', Constant::STUDENT)->first();
    $student->syncPermissions(
      Permission::where('name', 'LIKE', 'users.show')
        ->orWhere('name', 'LIKE', 'users.update')
        ->get()
    );
  }
}
