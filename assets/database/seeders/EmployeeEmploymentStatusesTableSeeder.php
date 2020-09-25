<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeEmploymentStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employee_employment_statuses')->delete();

        DB::table('employee_employment_statuses')->insert([
            [
                'id'                   => 1,
                'user_id'              => 1,
                'employee_id'          => 1,
                'employment_status_id' => 23,
                'effective_at'         => '2018-09-25',
                'comment'              => null,
                'created_at'           => now(),
                'updated_at'           => now(),
            ],
            [
                'id'                   => 2,
                'user_id'              => 1,
                'employee_id'          => 1,
                'employment_status_id' => 24,
                'effective_at'         => '2019-03-25',
                'comment'              => null,
                'created_at'           => now(),
                'updated_at'           => now(),
            ],
            [
                'id'                   => 3,
                'user_id'              => 1,
                'employee_id'          => 1,
                'employment_status_id' => 25,
                'effective_at'         => '2019-03-25',
                'comment'              => null,
                'created_at'           => now(),
                'updated_at'           => now(),
            ],
        ]);
    }
}
