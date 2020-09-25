<?php

namespace Database\Seeders;

use HRis\PIM\Eloquent\PayType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PayTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employee_fields')->where('class', PayType::class)->delete();

        DB::table('employee_fields')->insert(
            [
                [
                    'class' => PayType::class,
                    'name'  => json_encode([
                        'en' => 'Salary',
                        'fr' => 'Un salaire',
                        'nl' => 'Salaris'
                    ]),
                    'sort_order' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'class' => PayType::class,
                    'name'  => json_encode([
                        'en' => 'Hourly',
                        'fr' => 'Toutes les heures',
                        'nl' => 'Elk uur'
                    ]),
                    'sort_order' => 2,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'class' => PayType::class,
                    'name'  => json_encode([
                        'en' => 'Commission',
                        'fr' => 'La commission',
                        'nl' => 'Commissie'
                    ]),
                    'sort_order' => 3,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]
        );
    }
}
