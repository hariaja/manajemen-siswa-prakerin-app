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
      'Mentor',
      'Teacher',
      'Student',
    ];

    foreach ($datas as $data) :
      $roles = Role::create([
        'name' => $data,
        'guard_name' => 'web'
      ]);
    endforeach;

    $leader = $roles->where('name', Constant::LEADER)->first();
    $leader->syncPermissions(
      Permission::where('name', 'LIKE', 'users.show')
        ->orWhere('name', 'LIKE', 'users.update')
        ->orWhere('name', 'LIKE', 'users.password')
        // Holidays menu
        ->orWhere('name', 'LIKE', 'holidays.index')
        ->orWhere('name', 'LIKE', 'holidays.create')
        ->orWhere('name', 'LIKE', 'holidays.store')
        ->orWhere('name', 'LIKE', 'holidays.edit')
        ->orWhere('name', 'LIKE', 'holidays.update')
        // Attendance menu
        ->orWhere('name', 'LIKE', 'attendances.index')
        ->orWhere('name', 'LIKE', 'attendances.create')
        ->orWhere('name', 'LIKE', 'attendances.store')
        ->orWhere('name', 'LIKE', 'attendances.show')
        ->orWhere('name', 'LIKE', 'attendances.edit')
        ->orWhere('name', 'LIKE', 'attendances.update')
        // Schedule menu
        ->orWhere('name', 'LIKE', 'schedules.index')
        // Mentor menu
        ->orWhere('name', 'LIKE', 'mentors.index')
        ->orWhere('name', 'LIKE', 'mentors.show')
        // Teacher menu
        ->orWhere('name', 'LIKE', 'teachers.index')
        ->orWhere('name', 'LIKE', 'teachers.show')
        // Study Program menu
        ->orWhere('name', 'LIKE', 'study-programs.index')
        ->orWhere('name', 'LIKE', 'study-programs.show')
        // School menu
        ->orWhere('name', 'LIKE', 'schools.index')
        // Student menu
        ->orWhere('name', 'LIKE', 'students.index')
        ->orWhere('name', 'LIKE', 'students.show')
        // Registration menu
        ->orWhere('name', 'LIKE', 'registrations.index')
        ->orWhere('name', 'LIKE', 'registrations.show')
        ->get()
    );

    $mentor = $roles->where('name', Constant::MENTOR)->first();
    $mentor->syncPermissions(
      Permission::where('name', 'LIKE', 'users.show')
        ->orWhere('name', 'LIKE', 'users.update')
        ->orWhere('name', 'LIKE', 'users.password')

        ->orWhere('name', 'LIKE', 'attendances.index')
        ->orWhere('name', 'LIKE', 'attendances.show')
        ->get()
    );

    $teacher = $roles->where('name', Constant::TEACHER)->first();
    $teacher->syncPermissions(
      Permission::where('name', 'LIKE', 'users.show')
        ->orWhere('name', 'LIKE', 'users.update')
        ->orWhere('name', 'LIKE', 'users.password')
        ->orWhere('name', 'LIKE', 'schedules.show')
        // Student menu
        ->orWhere('name', 'LIKE', 'students.index')
        ->orWhere('name', 'LIKE', 'students.create')
        ->orWhere('name', 'LIKE', 'students.store')
        ->orWhere('name', 'LIKE', 'students.edit')
        ->orWhere('name', 'LIKE', 'students.update')
        ->orWhere('name', 'LIKE', 'students.show')
        // Registration menu
        ->orWhere('name', 'LIKE', 'registrations.index')
        ->orWhere('name', 'LIKE', 'registrations.create')
        ->orWhere('name', 'LIKE', 'registrations.store')
        ->orWhere('name', 'LIKE', 'registrations.edit')
        ->orWhere('name', 'LIKE', 'registrations.update')
        ->orWhere('name', 'LIKE', 'registrations.show')

        ->orWhere('name', 'LIKE', 'attendances.index')
        ->orWhere('name', 'LIKE', 'attendances.show')
        ->get()
    );
  }
}
