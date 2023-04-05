<?php

namespace Database\Seeders;

use App\Models\Holiday;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HolidaySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $items = [
      [
        'study_program_id' => 1,
        'title' => 'Hari Libur Nasional',
        'description' => 'Ini adalah contoh menambahkan hari libur',
        'holiday_date' => '2023-05-22',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      [
        'study_program_id' => 2,
        'title' => 'Hari Libur Lebaran',
        'description' => 'Ini adalah contoh menambahkan hari libur',
        'holiday_date' => '2023-05-22',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ];

    $collects = collect($items);
    foreach ($collects as $key => $value) :
      Holiday::firstOrCreate($value);
    endforeach;
  }
}
