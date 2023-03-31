<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $items = [
      [
        'title' => 'Gelombang I',
        'start' => '2022-08-1',
        'end' => '2022-10-31',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      [
        'title' => 'Gelombang II',
        'start' => '2022-11-01',
        'end' => '2023-01-31',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      [
        'title' => 'Gelombang III',
        'start' => '2023-02-01',
        'end' => '2023-04-30',
        'created_at' => now(),
        'updated_at' => now(),
        'status' => 1
      ],
    ];

    $collects = collect($items);
    foreach ($collects as $key => $value) :
      Schedule::firstOrCreate($value);
    endforeach;
  }
}
