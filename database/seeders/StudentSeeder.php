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
    $ayu = User::factory()->create([
      'name' => 'Ayu Budi Laksana',
      'email' => 'ayu@gmail.com',
      'phone' => '085797790833',
      'password' => bcrypt('password'),
      'email_verified_at' => now(),
      'remember_token' => Str::random(60),
      'status' => Constant::INACTIVE,
    ]);
    $ayu->assignRole(Constant::STUDENT);

    $riki = User::factory()->create([
      'name' => 'Riki Adi Permana',
      'email' => 'riki@gmail.com',
      'phone' => '085797790844',
      'password' => bcrypt('password'),
      'email_verified_at' => now(),
      'remember_token' => Str::random(60),
      'status' => Constant::INACTIVE,
    ]);
    $riki->assignRole(Constant::STUDENT);

    $jamal = User::factory()->create([
      'name' => 'Jamaludin',
      'email' => 'jamal@gmail.com',
      'phone' => '085797790822',
      'password' => bcrypt('password'),
      'email_verified_at' => now(),
      'remember_token' => Str::random(60),
      'status' => Constant::INACTIVE,
    ]);
    $jamal->assignRole(Constant::STUDENT);

    Student::firstOrcreate([
      'user_id' => $ayu->id,
      'school_id' => 14,
      'nisn' => '312019115',
      'major' => 'Teknik Komputer',
      'date_birth' => '2000-11-05',
      'gender' => Constant::FEMALE,
      'address' => 'Jl. Kusuma Nagara No. 31 Bandung, Jawa Barat',
    ]);

    Student::firstOrcreate([
      'user_id' => $riki->id,
      'school_id' => 14,
      'nisn' => '312019116',
      'major' => 'Teknik Komputer',
      'date_birth' => '2000-11-05',
      'gender' => Constant::FEMALE,
      'address' => 'Jl. Kusuma Nagara No. 31 Bandung, Jawa Barat',
    ]);

    Student::firstOrcreate([
      'user_id' => $jamal->id,
      'school_id' => 14,
      'nisn' => '312019117',
      'major' => 'Teknik Komputer',
      'date_birth' => '2000-11-05',
      'gender' => Constant::FEMALE,
      'address' => 'Jl. Kusuma Nagara No. 31 Bandung, Jawa Barat',
    ]);
  }
}
