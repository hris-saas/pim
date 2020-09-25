<?php

namespace Database\Seeders;

use HRis\PIM\Eloquent\Division;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employee_fields')->where('class', Division::class)->delete();

        DB::table('employee_fields')->insert(
            [
                [
                    'class' => Division::class,
                    'name'  => json_encode([
                       'en' => 'Development',
                       'fr' => 'Développement',
                       'nl' => 'Ontwikkeling'
                    ]),
                    'sort_order' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]
        );
    }
}
