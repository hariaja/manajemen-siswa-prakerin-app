<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Helpers\Global\Constant;
use App\Models\Leader;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LeaderSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $user = User::factory()->create([
      'name' => 'Anita Rahayu',
      'email' => 'anita@gmail.com',
      'phone' => '085890000833',
      'password' => bcrypt('password'),
      'email_verified_at' => now(),
      'remember_token' => Str::random(60),
      'status' => Constant::ACTIVE,
    ]);
    $user->assignRole(Constant::LEADER);

    Leader::create([
      'user_id' => $user->id,
      'study_program_id' => 2,
      'nidn' => '312020000',
      'gender' => Constant::FEMALE,
    ]);
  }
}
