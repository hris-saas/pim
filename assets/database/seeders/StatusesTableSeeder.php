<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use HRis\ATS\Eloquent\Step;
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
                'id'           => 1,
                'parent_id'    => null,
                'sort_order'   => 1,
                'class'        => Step::class,
                'name'         => 'Pending',
                'is_completed' => 0,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'id'           => 2,
                'parent_id'    => null,
                'sort_order'   => 2,
                'class'        => Step::class,
                'name'         => 'Reviewing',
                'is_completed' => 0,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'id'           => 3,
                'parent_id'    => null,
                'sort_order'   => 3,
                'class'        => Step::class,
                'name'         => 'Completed',
                'is_completed' => 1,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}
