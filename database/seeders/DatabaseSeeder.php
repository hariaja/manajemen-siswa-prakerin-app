<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call([
      PermissionCategorySeeder::class,
      PermissionSeeder::class,
      RoleSeeder::class,
      UserSeeder::class,
      ScheduleSeeder::class,
      StudyProgramSeeder::class,
      SchoolSeeder::class,
      LeaderSeeder::class,
      MentorSeeder::class,
      TeacherSeeder::class,
      StudentSeeder::class,
      HolidaySeeder::class,
      AttendanceSeeder::class,
    ]);
  }
}
