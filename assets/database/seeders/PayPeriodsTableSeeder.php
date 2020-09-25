<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use HRis\PIM\Eloquent\PayPeriod;
use Illuminate\Support\Facades\DB;

class PayPeriodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employee_fields')->where('class', PayPeriod::class)->delete();

        DB::table('employee_fields')->insert([
            [
                'class' => PayPeriod::class,
                'name'  => json_encode([
                    'en' => 'Twice a month',
                    'fr' => 'Deux fois par mois',
                    'nl' => 'Twee keer per maand'
                ]),
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'class' => PayPeriod::class,
                'name'  => json_encode([
                    'en' => 'Monthly',
                    'fr' => 'Mensuel',
                    'nl' => 'Maandelijks'
                ]),
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'class' => PayPeriod::class,
                'name'  => json_encode([
                    'en' => 'Weekly',
                    'fr' => 'Hebdomadaire',
                    'nl' => 'Wekelijks'
                ]),
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
