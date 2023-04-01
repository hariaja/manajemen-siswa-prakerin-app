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
        'updated_at' => now()
      ],
      [
        'name' => 'users.show',
        'permission_category_id' => 1,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'name' => 'users.edit',
        'permission_category_id' => 1,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'name' => 'users.update',
        'permission_category_id' => 1,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'name' => 'users.password',
        'permission_category_id' => 1,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'name' => 'users.destroy',
        'permission_category_id' => 1,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
      ],

      // Roles
      [
        'name' => 'roles.index',
        'permission_category_id' => 2,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'name' => 'roles.create',
        'permission_category_id' => 2,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'name' => 'roles.store',
        'permission_category_id' => 2,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'name' => 'roles.edit',
        'permission_category_id' => 2,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'name' => 'roles.update',
        'permission_category_id' => 2,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'name' => 'roles.destroy',
        'permission_category_id' => 2,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
      ],

      // Schedules
      [
        'name' => 'schedules.index',
        'permission_category_id' => 3,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'name' => 'schedules.create',
        'permission_category_id' => 3,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'name' => 'schedules.store',
        'permission_category_id' => 3,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'name' => 'schedules.edit',
        'permission_category_id' => 3,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'name' => 'schedules.update',
        'permission_category_id' => 3,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'name' => 'schedules.destroy',
        'permission_category_id' => 3,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
      ],

      // Study Programs
      [
        'name' => 'study-programs.index',
        'permission_category_id' => 4,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'name' => 'study-programs.create',
        'permission_category_id' => 4,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'name' => 'study-programs.store',
        'permission_category_id' => 4,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'name' => 'study-programs.edit',
        'permission_category_id' => 4,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'name' => 'study-programs.update',
        'permission_category_id' => 4,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'name' => 'study-programs.destroy',
        'permission_category_id' => 4,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
      ],

      // Leaders
      [
        'name' => 'leaders.index',
        'permission_category_id' => 5,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'name' => 'leaders.create',
        'permission_category_id' => 5,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'name' => 'leaders.store',
        'permission_category_id' => 5,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'name' => 'leaders.show',
        'permission_category_id' => 5,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'name' => 'leaders.edit',
        'permission_category_id' => 5,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'name' => 'leaders.update',
        'permission_category_id' => 5,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'name' => 'leaders.destroy',
        'permission_category_id' => 5,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
      ],
    ];

    $collects = collect($permissions);
    foreach ($collects as $key => $value) :
      Permission::firstOrCreate($value);
    endforeach;
  }
}
