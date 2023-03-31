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
    ];

    // Create Permissions
    Permission::insert($permissions);
  }
}
