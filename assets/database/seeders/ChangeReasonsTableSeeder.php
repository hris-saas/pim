<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use HRis\PIM\Eloquent\ChangeReason;

class ChangeReasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employee_fields')->where('class', ChangeReason::class)->delete();

        DB::table('employee_fields')->insert([
            [
                'class' => ChangeReason::class,
                'name'  => json_encode([
                    'en' => 'Initial Offer',
                    'fr' => 'Créatif',
                    'nl' => 'Initiële aanbieding',
                ]),
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'class' => ChangeReason::class,
                'name'  => json_encode([
                    'en' => 'Promoted',
                    'fr' => 'Ingénierie',
                    'nl' => 'Bevorderd',
                ]),
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'class' => ChangeReason::class,
                'name'  => json_encode([
                    'en' => 'Demoted',
                    'fr' => 'Opération',
                    'nl' => 'Gedegradeerd',
                ]),
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
