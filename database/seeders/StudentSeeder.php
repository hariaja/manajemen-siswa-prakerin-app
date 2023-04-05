<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Helpers\Global\Constant;
use App\Models\Student;

class StudentSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $user1 = User::factory()->create([
      'name' => 'Ayu Budi Laksana',
      'email' => 'ayu@gmail.com',
      'phone' => '085797790833',
      'password' => bcrypt('password'),
      'email_verified_at' => now(),
      'remember_token' => Str::random(60),
      'status' => Constant::INACTIVE,
    ]);
    $user1->assignRole(Constant::STUDENT);

    Student::create([
      'user_id' => $user1->id,
      'school_id' => 14,
      'nisn' => '312019115',
      'major' => 'Teknik Komputer',
      'date_birth' => '2000-11-05',
      'gender' => Constant::FEMALE,
      'address' => 'Jl. Kusuma Nagara No. 31 Bandung, Jawa Barat',
    ]);
  }
}
