<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use HRis\PIM\Eloquent\Department;
use Illuminate\Support\Facades\DB;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employee_fields')->where('class', Department::class)->delete();

        DB::table('employee_fields')->insert([
            [
                'class' => Department::class,
                'name'  => json_encode([
                    'en' => 'Creative',
                    'fr' => 'Créatif',
                    'nl' => 'Creatief'
                ]),
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'class' => Department::class,
                'name'  => json_encode([
                    'en' => 'Engineering',
                    'fr' => 'Ingénierie',
                    'nl' => 'Bouwkunde'
                ]),
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'class' => Department::class,
                'name'  => json_encode([
                    'en' => 'Operation',
                    'fr' => 'Opération',
                    'nl' => 'Operatie'
                ]),
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
