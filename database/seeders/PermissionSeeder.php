<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // reset cahced roles and permission
    app()[PermissionRegistrar::class]->forgetCachedPermissions();

    $permissions = [
      // Users
      [
        'name' => 'users.index',
        'permission_category_id' => 1,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'users.show',
        'permission_category_id' => 1,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'users.update',
        'permission_category_id' => 1,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'users.status',
        'permission_category_id' => 1,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'users.password',
        'permission_category_id' => 1,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      // Roles
      [
        'name' => 'roles.index',
        'permission_category_id' => 2,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'roles.create',
        'permission_category_id' => 2,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'roles.store',
        'permission_category_id' => 2,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'roles.edit',
        'permission_category_id' => 2,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'roles.update',
        'permission_category_id' => 2,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'roles.destroy',
        'permission_category_id' => 2,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      // Schedules
      [
        'name' => 'schedules.index',
        'permission_category_id' => 3,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'schedules.create',
        'permission_category_id' => 3,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'schedules.store',
        'permission_category_id' => 3,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'schedules.show',
        'permission_category_id' => 3,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'schedules.edit',
        'permission_category_id' => 3,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'schedules.show',
        'permission_category_id' => 3,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'schedules.update',
        'permission_category_id' => 3,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'schedules.destroy',
        'permission_category_id' => 3,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      // Study Programs
      [
        'name' => 'study-programs.index',
        'permission_category_id' => 4,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'study-programs.create',
        'permission_category_id' => 4,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'study-programs.store',
        'permission_category_id' => 4,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'study-programs.edit',
        'permission_category_id' => 4,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'study-programs.update',
        'permission_category_id' => 4,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'study-programs.destroy',
        'permission_category_id' => 4,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      // Leaders
      [
        'name' => 'leaders.index',
        'permission_category_id' => 5,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'leaders.create',
        'permission_category_id' => 5,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'leaders.store',
        'permission_category_id' => 5,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'leaders.show',
        'permission_category_id' => 5,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'leaders.edit',
        'permission_category_id' => 5,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'leaders.update',
        'permission_category_id' => 5,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'leaders.destroy',
        'permission_category_id' => 5,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      // Mentors
      [
        'name' => 'mentors.index',
        'permission_category_id' => 6,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'mentors.create',
        'permission_category_id' => 6,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'mentors.store',
        'permission_category_id' => 6,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'mentors.show',
        'permission_category_id' => 6,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'mentors.edit',
        'permission_category_id' => 6,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'mentors.update',
        'permission_category_id' => 6,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'mentors.destroy',
        'permission_category_id' => 6,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      // Schools
      [
        'name' => 'schools.index',
        'permission_category_id' => 7,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'schools.create',
        'permission_category_id' => 7,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'schools.store',
        'permission_category_id' => 7,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'schools.edit',
        'permission_category_id' => 7,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'schools.update',
        'permission_category_id' => 7,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'schools.destroy',
        'permission_category_id' => 7,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      // Teachers
      [
        'name' => 'teachers.index',
        'permission_category_id' => 8,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'teachers.show',
        'permission_category_id' => 8,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'teachers.edit',
        'permission_category_id' => 8,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'teachers.update',
        'permission_category_id' => 8,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'teachers.destroy',
        'permission_category_id' => 8,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      // Students
      [
        'name' => 'students.index',
        'permission_category_id' => 9,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'students.create',
        'permission_category_id' => 9,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'students.store',
        'permission_category_id' => 9,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'students.show',
        'permission_category_id' => 9,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'students.edit',
        'permission_category_id' => 9,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'students.show',
        'permission_category_id' => 9,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'students.update',
        'permission_category_id' => 9,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'students.destroy',
        'permission_category_id' => 9,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      // Registrations
      [
        'name' => 'registrations.index',
        'permission_category_id' => 10,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'registrations.create',
        'permission_category_id' => 10,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'registrations.store',
        'permission_category_id' => 10,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'registrations.update',
        'permission_category_id' => 10,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'registrations.show',
        'permission_category_id' => 10,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'registrations.destroy',
        'permission_category_id' => 10,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      // Holidays
      [
        'name' => 'holidays.index',
        'permission_category_id' => 11,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'holidays.create',
        'permission_category_id' => 11,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'holidays.store',
        'permission_category_id' => 11,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'holidays.edit',
        'permission_category_id' => 11,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'holidays.update',
        'permission_category_id' => 11,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'holidays.destroy',
        'permission_category_id' => 11,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      // Attendances
      [
        'name' => 'attendances.index',
        'permission_category_id' => 12,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'attendances.create',
        'permission_category_id' => 12,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'attendances.store',
        'permission_category_id' => 12,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'attendances.edit',
        'permission_category_id' => 12,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'attendances.update',
        'permission_category_id' => 12,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'attendances.destroy',
        'permission_category_id' => 12,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      // Presences
      [
        'name' => 'presences.index',
        'permission_category_id' => 13,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'presences.create',
        'permission_category_id' => 13,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'presences.store',
        'permission_category_id' => 13,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'presences.edit',
        'permission_category_id' => 13,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'presences.update',
        'permission_category_id' => 13,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'presences.destroy',
        'permission_category_id' => 13,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      // Excuses
      [
        'name' => 'excuses.index',
        'permission_category_id' => 14,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'excuses.create',
        'permission_category_id' => 14,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'excuses.store',
        'permission_category_id' => 14,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'excuses.edit',
        'permission_category_id' => 14,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'excuses.update',
        'permission_category_id' => 14,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'excuses.destroy',
        'permission_category_id' => 14,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ];

    $collects = collect($permissions);
    foreach ($collects as $key => $value) :
      Permission::firstOrCreate($value);
    endforeach;
  }
}
