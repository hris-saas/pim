<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StepsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('steps')->delete();

        DB::table('steps')->insert([
            [
                'id'         => 1,
                'name'       => 'Resume Screening',
                'slug'       => 'resume-screening',
                'created_at' => now(),
                'updated_at' => now(),
              ],
        ]);
    }
}
