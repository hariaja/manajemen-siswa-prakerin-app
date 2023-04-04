<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Helpers\Global\Constant;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $teacher = Teacher::where('school_id', 14)->first();

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

    $user2 = User::factory()->create([
      'name' => 'Alam Paku Alamsyah',
      'email' => 'alam@gmail.com',
      'phone' => '085790077833',
      'password' => bcrypt('password'),
      'email_verified_at' => now(),
      'remember_token' => Str::random(60),
      'status' => Constant::INACTIVE,
    ]);
    $user2->assignRole(Constant::STUDENT);

    Student::create([
      'user_id' => $user1->id,
      'school_id' => $teacher->school_id,
      'nisn' => '312019115',
      'major' => 'Teknik Komputer',
      'date_birth' => '2000-11-05',
      'gender' => Constant::FEMALE,
      'address' => 'Jl. Kusuma Nagara No. 31 Bandung, Jawa Barat',
    ]);

    Student::create([
      'user_id' => $user2->id,
      'school_id' => $teacher->school_id,
      'nisn' => '312019120',
      'major' => 'Teknik Komputer',
      'date_birth' => '2000-10-16',
      'gender' => Constant::MALE,
      'address' => 'Jl. Kusuma Nagara No. 31 Bandung, Jawa Barat',
    ]);
  }
}
