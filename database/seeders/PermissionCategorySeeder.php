<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PermissionCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionCategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $items = [
      'users.name',
      'roles.name',
      'schedules.name',
      'study-programs.name',
      'leaders.name',
      'mentors.name',
      'schools.name',
      'teachers.name',
      'students.name',
      'registrations.name',
      'holidays.name',
      'attendances.name',
      'excuses.name',
      'students.presences.name',
      'journals.name',
    ];

    foreach ($items as $name) :
      PermissionCategory::create([
        'name' => $name
      ]);
    endforeach;
  }
}
