<?php

namespace Database\Seeders;

use HRis\PIM\Eloquent\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->delete();

        DB::table('statuses')->insert([
            [
                'parent_id'    => null,
                'sort_order'   => 1,
                'class'        => Status::class,
                'name'  => json_encode([
                    'en' => 'Active',
                    'fr' => 'Activo',
                    'nl' => 'Actief',
                ]),
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'parent_id'    => null,
                'sort_order'   => 2,
                'class'        => Status::class,
                'name'  => json_encode([
                    'en' => 'Inactive',
                    'fr' => 'Inactivo',
                    'nl' => 'Inactief',
                ]),
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
//            [
//                'parent_id'    => null,
//                'sort_order'   => 3,
//                'class'        => Step::class,
//                'name'         => 'Completed',
//                'is_completed' => 1,
//                'created_at'   => now(),
//                'updated_at'   => now(),
//            ],
//            [
//                'parent_id'    => null,
//                'sort_order'   => 1,
//                'class'        => Step::class,
//                'name'         => 'Pending',
//                'is_completed' => 0,
//                'created_at'   => now(),
//                'updated_at'   => now(),
//            ],
//            [
//                'parent_id'    => null,
//                'sort_order'   => 2,
//                'class'        => Step::class,
//                'name'         => 'Reviewing',
//                'is_completed' => 0,
//                'created_at'   => now(),
//                'updated_at'   => now(),
//            ],
//            [
//                'parent_id'    => null,
//                'sort_order'   => 3,
//                'class'        => Step::class,
//                'name'         => 'Completed',
//                'is_completed' => 1,
//                'created_at'   => now(),
//                'updated_at'   => now(),
//            ],
        ]);
    }
}
