<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use HRis\PIM\Eloquent\Relationship;

class RelationshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employee_fields')->where('class', Relationship::class)->delete();

        DB::table('employee_fields')->insert([
            [
                'class' => Relationship::class,
                'name'  => json_encode([
                    'en' => 'Spouse',
                    'fr' => 'Époux',
                    'nl' => 'Echtgenoot'
                ]),
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'class' => Relationship::class,
                'name'  => json_encode([
                    'en' => 'Mother',
                    'fr' => 'Mère',
                    'nl' => 'Moeder'
                ]),
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'class' => Relationship::class,
                'name'  => json_encode([
                    'en' => 'Father',
                    'fr' => 'Père',
                    'nl' => 'Vader'
                ]),
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'class' => Relationship::class,
                'name'  => json_encode([
                    'en' => 'Brother',
                    'fr' => 'Frère',
                    'nl' => 'Broer'
                ]),
                'sort_order' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'class' => Relationship::class,
                'name'  => json_encode([
                    'en' => 'Sister',
                    'fr' => 'Sœur',
                    'nl' => 'Zus'
                ]),
                'sort_order' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
