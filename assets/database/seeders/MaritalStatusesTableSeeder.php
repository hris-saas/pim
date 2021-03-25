<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use HRis\PIM\Eloquent\MaritalStatus;

class MaritalStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->where('class', MaritalStatus::class)->delete();

        DB::table('statuses')->insert(
            [
                [
                    'class' => MaritalStatus::class,
                    'name'  => json_encode([
                        'en' => 'Single',
                        'fr' => 'Célibataire',
                        'nl' => 'alleenstaand',
                    ]),
                    'sort_order' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'class' => MaritalStatus::class,
                    'name'  => json_encode([
                        'en' => 'Married',
                        'fr' => 'Marié',
                        'nl' => 'Getrouwd',
                    ]),
                    'sort_order' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'class' => MaritalStatus::class,
                    'name'  => json_encode([
                        'en' => 'Other',
                        'fr' => 'Autre',
                        'nl' => 'Andere',
                    ]),
                    'sort_order' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]
        );
    }
}
