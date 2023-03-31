<?php

namespace Database\Seeders;

use App\Helpers\Global\Constant;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $admin = User::factory()->create([
      'name' => 'Administrator',
      'email' => 'admin@gmail.com',
      'phone' => '085798888733',
      'password' => bcrypt('password'),
      'email_verified_at' => now(),
      'remember_token' => Str::random(60),
      'status' => 1
    ]);
    $admin->assignRole(Constant::ADMIN);
  }
}
