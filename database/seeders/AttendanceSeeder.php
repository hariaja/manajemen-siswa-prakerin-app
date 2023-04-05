<?php

namespace Database\Seeders;

use App\Models\Attendance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $items = [
      [
        'study_program_id' => 1,
        'title' => 'Absensi Prakerin Administrasi Bisnis',
        'description' => 'Absensi ini untuk siswa atau peserta prakerin yang terdaftar di program studi Administrasi Bisnis',
        'start_time' => '07:00',
        'timeout_start_time' => '07:30',
        'end_time' => '15:00',
        'timeout_end_time' => '15:30',
        'created_at' => now(),
        'updated_at' => now()
      ],

      [
        'study_program_id' => 2,
        'title' => 'Absensi Prakerin Teknik Komputer',
        'description' => 'Absensi ini untuk siswa atau peserta prakerin yang terdaftar di program studi Teknik Komputer',
        'start_time' => '07:00',
        'timeout_start_time' => '07:30',
        'end_time' => '15:00',
        'timeout_end_time' => '15:30',
        'created_at' => now(),
        'updated_at' => now()
      ],

      [
        'study_program_id' => 3,
        'title' => 'Absensi Prakerin Teknik Mesin',
        'description' => 'Absensi ini untuk siswa atau peserta prakerin yang terdaftar di program studi Teknik Mesin',
        'start_time' => '07:00',
        'timeout_start_time' => '07:30',
        'end_time' => '15:00',
        'timeout_end_time' => '15:30',
        'created_at' => now(),
        'updated_at' => now()
      ],

      [
        'study_program_id' => 4,
        'title' => 'Absensi Prakerin Teknik Sipil',
        'description' => 'Absensi ini untuk siswa atau peserta prakerin yang terdaftar di program studi Teknik Sipil',
        'start_time' => '07:00',
        'timeout_start_time' => '07:30',
        'end_time' => '15:00',
        'timeout_end_time' => '15:30',
        'created_at' => now(),
        'updated_at' => now()
      ],
    ];

    $collects = collect($items);
    foreach ($collects as $key => $value) :
      Attendance::firstOrCreate($value);
    endforeach;
  }
}
