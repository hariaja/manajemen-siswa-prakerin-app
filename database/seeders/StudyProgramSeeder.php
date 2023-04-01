<?php

namespace Database\Seeders;

use App\Models\StudyProgram;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudyProgramSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $items = [
      [
        'name' => 'Administrasi Bisnis',
        'created_at' => now(),
        'updated_at' => now(),
        'status' => 1
      ],
      [
        'name' => 'Teknik Komputer',
        'created_at' => now(),
        'updated_at' => now(),
        'status' => 1
      ],
      [
        'name' => 'Teknik Mesin',
        'created_at' => now(),
        'updated_at' => now(),
        'status' => 1,
      ],
      [
        'name' => 'Teknik Sipil',
        'created_at' => now(),
        'updated_at' => now(),
        'status' => 1,
      ],
    ];

    $collects = collect($items);
    foreach ($collects as $key => $value) :
      StudyProgram::firstOrCreate($value);
    endforeach;
  }
}
