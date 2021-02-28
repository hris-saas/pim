<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use HRis\PIM\Eloquent\EmploymentStatus;

class EmploymentStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->where('class', EmploymentStatus::class)->delete();

        DB::table('statuses')->insert([
            [
              'sort_order' => 1,
              'class' => EmploymentStatus::class,
              'name'  => json_encode([
                'en' => 'Probation',
                'fr' => 'La probation',
                'nl' => 'Proeftijd'
              ]),
              'created_at' => now(),
              'updated_at' => now(),
            ],
            [
              'sort_order' => 2,
              'class' => EmploymentStatus::class,
              'name'  => json_encode([
                'en' => 'Regular',
                'fr' => 'Ordinaire',
                'nl' => 'Regelmatig'
              ]),
              'created_at' => now(),
              'updated_at' => now(),
            ],
            [
              'sort_order' => 3,
              'class' => EmploymentStatus::class,
              'name'  => json_encode([
                'en' => 'Homebased',
                'fr' => 'À domicile',
                'nl' => 'Vanuit huis'
              ]),
              'created_at' => now(),
              'updated_at' => now(),
            ],
        ]);
    }
}
