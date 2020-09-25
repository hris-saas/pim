<?php

namespace Database\Seeders;

use HRis\PIM\Eloquent\JobTitle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobTitlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employee_fields')->where('class', JobTitle::class)->delete();

        DB::table('employee_fields')->insert([
            [
              'sort_order' => 1,
              'class' => JobTitle::class,
              'name'  => json_encode([
                'en' => 'Frontend Engineer',
                'fr' => 'Ingénieur Frontend',
                'nl' => 'Frontend Engineer'
              ]),
              'created_at' => now(),
              'updated_at' => now(),
            ],
            [
              'sort_order' => 2,
              'class' => JobTitle::class,
              'name'  => json_encode([
                'en' => 'Backend Engineer',
                'fr' => 'Ingénieur Backend',
                'nl' => 'Backend Engineer'
              ]),
              'created_at' => now(),
              'updated_at' => now(),
            ],
            [
              'sort_order' => 3,
              'class' => JobTitle::class,
              'name'  => json_encode([
                'en' => 'ERP Engineer',
                'fr' => 'Ingénieur ERP',
                'nl' => 'ERP Engineer'
              ]),
              'created_at' => now(),
              'updated_at' => now(),
            ],
            [
              'sort_order' => 4,
              'class' => JobTitle::class,
              'name'  => json_encode([
                'en' => 'UI/UX Designer',
                'fr' => 'Concepteur UI/UX',
                'nl' => 'UI/UX Designer'
              ]),
              'created_at' => now(),
              'updated_at' => now(),
            ],
            [
              'sort_order' => 5,
              'class' => JobTitle::class,
              'name'  => json_encode([
                'en' => 'QA Engineer',
                'fr' => 'Ingénieur QA',
                'nl' => 'QA Engineer'
              ]),
              'created_at' => now(),
              'updated_at' => now(),
            ],
        ]);
    }
}
