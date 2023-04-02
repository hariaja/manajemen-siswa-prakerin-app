<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Helpers\Global\Constant;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TeacherSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $user = User::factory()->create([
      'name' => 'Saya Adalah Guru',
      'email' => 'teacher@gmail.com',
      'phone' => '085797777833',
      'password' => bcrypt('password'),
      'email_verified_at' => now(),
      'remember_token' => Str::random(60),
      'status' => Constant::ACTIVE,
    ]);
    $user->assignRole(Constant::TEACHER);

    Teacher::create([
      'user_id' => $user->id,
      'school_id' => 14,
      'gender' => Constant::FEMALE,
      'address' => 'Planet Saturnus',
    ]);
  }
}
