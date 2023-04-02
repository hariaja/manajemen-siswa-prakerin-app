<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mentor;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Helpers\Global\Constant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MentorSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $user = User::factory()->create([
      'name' => 'Saya Adalah Pembimbing',
      'email' => 'mentor@gmail.com',
      'phone' => '085890000800',
      'password' => bcrypt('password'),
      'email_verified_at' => now(),
      'remember_token' => Str::random(60),
      'status' => Constant::ACTIVE,
    ]);
    $user->assignRole(Constant::MENTOR);

    Mentor::create([
      'user_id' => $user->id,
      'study_program_id' => 2,
      'gender' => Constant::FEMALE,
    ]);
  }
}
