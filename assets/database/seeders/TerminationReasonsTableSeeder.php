<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use HRis\PIM\Eloquent\TerminationReason;

class TerminationReasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employee_fields')->where('class', TerminationReason::class)->delete();

        DB::table('employee_fields')->insert(
            [
                [
                    'class' => TerminationReason::class,
                    'name'  => json_encode([
                        'en' => 'Resigned',
                        'fr' => 'Résigné',
                        'nl' => 'Ontslag genomen'
                    ]),
                    'sort_order' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'class' => TerminationReason::class,
                    'name'  => json_encode([
                        'en' => 'Retired',
                        'fr' => 'Retraité',
                        'nl' => 'Gepensioneerd'
                    ]),
                    'sort_order' => 2,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]
        );
    }
}
