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
    $user1 = User::factory()->create([
      'name' => 'Nisrina Amalina',
      'email' => 'nisrina@gmail.com',
      'phone' => '085797777833',
      'password' => bcrypt('password'),
      'email_verified_at' => now(),
      'remember_token' => Str::random(60),
      'status' => Constant::ACTIVE,
    ]);
    $user1->assignRole(Constant::TEACHER);

    $user2 = User::factory()->create([
      'name' => 'Fajar Abdul Malik',
      'email' => 'fajar@gmail.com',
      'phone' => '085797777888',
      'password' => bcrypt('password'),
      'email_verified_at' => now(),
      'remember_token' => Str::random(60),
      'status' => Constant::ACTIVE,
    ]);
    $user2->assignRole(Constant::TEACHER);

    Teacher::create([
      'user_id' => $user1->id,
      'school_id' => 14,
      'gender' => Constant::FEMALE,
      'address' => 'Planet Saturnus',
    ]);

    Teacher::create([
      'user_id' => $user2->id,
      'school_id' => 3,
      'gender' => Constant::MALE,
      'address' => 'Planet Saturnus',
    ]);
  }
}
