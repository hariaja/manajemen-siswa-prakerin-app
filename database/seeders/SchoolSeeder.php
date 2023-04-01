<?php

namespace Database\Seeders;

use App\Helpers\Global\Constant;
use App\Models\School;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $items = [
      // Kec. Cikole SMK
      [
        'npsn' => '20221568',
        'name' => 'SMKN 1 SUKABUMI',
        'education' => Constant::SMK,
        'status' => Constant::NEGERI,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'npsn' => '20221570',
        'name' => 'SMKN 3 SUKABUMI',
        'education' => Constant::SMK,
        'status' => Constant::NEGERI,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'npsn' => '69921197',
        'name' => 'SMK IT AL-FATH',
        'education' => Constant::SMK,
        'status' => Constant::SWASTA,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'npsn' => '20221566',
        'name' => 'SMKS MUHAMMADIYAH 1 SUKABUMI',
        'education' => Constant::SMK,
        'status' => Constant::SWASTA,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'npsn' => '20270889',
        'name' => 'SMKS PASIM PLUS SUKABUMI',
        'education' => Constant::SMK,
        'status' => Constant::SWASTA,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'npsn' => '69757214',
        'name' => 'SMKS PERSADA',
        'education' => Constant::SMK,
        'status' => Constant::SWASTA,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'npsn' => '20221617',
        'name' => 'SMKS TAMANSISWA SUKABUMI',
        'education' => Constant::SMK,
        'status' => Constant::SWASTA,
        'created_at' => now(),
        'updated_at' => now()
      ],

      // Kec. Gunung Puyuh SMK
      [
        'npsn' => '20254980',
        'name' => 'SMKS KOMPUTER ABDI BANGSA SUKABUMI',
        'education' => Constant::SMK,
        'status' => Constant::SWASTA,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'npsn' => '69757153',
        'name' => 'SMKS PRIORITY',
        'education' => Constant::SMK,
        'status' => Constant::SWASTA,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'npsn' => '20221616',
        'name' => 'SMKS SILIWANGI SUKABUMI',
        'education' => Constant::SMK,
        'status' => Constant::SWASTA,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'npsn' => '20253909',
        'name' => 'SMKS ULUL ALBAB SUKABUMI',
        'education' => Constant::SMK,
        'status' => Constant::SWASTA,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'npsn' => '20221618',
        'name' => 'SMKS YASPI SYAMSUL ULUM SUKABUMI',
        'education' => Constant::SMK,
        'status' => Constant::SWASTA,
        'created_at' => now(),
        'updated_at' => now()
      ],

      // Kec. Warudoyong SMK
      [
        'npsn' => '20221573',
        'name' => 'SMKS ISLAM PENGUJI SUKABUMI',
        'education' => Constant::SMK,
        'status' => Constant::SWASTA,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'npsn' => '20229796',
        'name' => 'SMKS PASUNDAN 1 SUKABUMI',
        'education' => Constant::SMK,
        'status' => Constant::SWASTA,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'npsn' => '20221571',
        'name' => 'SMKS PASUNDAN 2 SUKABUMI',
        'education' => Constant::SMK,
        'status' => Constant::SWASTA,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'npsn' => '20221596',
        'name' => 'SMKS TEKNOLOGI PLUS PADJADJARAN SUKABUMI',
        'education' => Constant::SMK,
        'status' => Constant::SWASTA,
        'created_at' => now(),
        'updated_at' => now()
      ],

      // Kec. Citamiang SMK
      [
        'npsn' => '20221569',
        'name' => 'SMKN 2 SUKABUMI',
        'education' => Constant::SMK,
        'status' => Constant::NEGERI,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'npsn' => '69894099',
        'name' => 'SMK MUTIARA CENDEKIA',
        'education' => Constant::SMK,
        'status' => Constant::SWASTA,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'npsn' => '20221572',
        'name' => 'SMKS PELITA YNH SUKABUMI',
        'education' => Constant::SMK,
        'status' => Constant::SWASTA,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'npsn' => '20221574',
        'name' => 'SMKS PGRI 1 SUKABUMI',
        'education' => Constant::SMK,
        'status' => Constant::SWASTA,
        'created_at' => now(),
        'updated_at' => now()
      ],

      // LEMBURSITU SMK
      [
        'npsn' => '20253907',
        'name' => 'SMKN 4 SUKABUMI',
        'education' => Constant::SMK,
        'status' => Constant::NEGERI,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'npsn' => '69899673',
        'name' => 'SMK IT AMAL ISLAMI',
        'education' => Constant::SMK,
        'status' => Constant::SWASTA,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'npsn' => '69757152',
        'name' => 'SMKS BINA SATYA MANDIRI',
        'education' => Constant::SMK,
        'status' => Constant::SWASTA,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'npsn' => '69757213',
        'name' => 'SMKS KESEHATAN TUNAS MADANI',
        'education' => Constant::SMK,
        'status' => Constant::SWASTA,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'npsn' => '20221595',
        'name' => 'SMKS PLUS BINA TEKNIK YLPI SUKABUMI',
        'education' => Constant::SMK,
        'status' => Constant::SWASTA,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'npsn' => '20265663',
        'name' => 'SMKS TERPADU IBADURRAHMAN',
        'education' => Constant::SMK,
        'status' => Constant::SWASTA,
        'created_at' => now(),
        'updated_at' => now()
      ],

      // BAROS SMK
      [
        'npsn' => '69757154',
        'name' => 'SMKS GEMA ISTIQOMAH',
        'education' => Constant::SMK,
        'status' => Constant::SWASTA,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'npsn' => '69754839',
        'name' => 'SMKS IT MADANI',
        'education' => Constant::SMK,
        'status' => Constant::SWASTA,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'npsn' => '20280579',
        'name' => 'SMKS PLUS AN-NABA',
        'education' => Constant::SMK,
        'status' => Constant::SWASTA,
        'created_at' => now(),
        'updated_at' => now()
      ],
    ];

    $collects = collect($items);
    foreach ($collects as $key => $value) :
      School::firstOrCreate($value);
    endforeach;
  }
}
