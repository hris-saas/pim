<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use HRis\PIM\Eloquent\Job;
use Faker\Generator as Faker;
use HRis\PIM\Eloquent\Division;
use HRis\PIM\Eloquent\JobTitle;
use HRis\PIM\Eloquent\Location;
use HRis\PIM\Eloquent\Department;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Job::class, function (Faker $faker) {
    return [
        'employee_id' => null,
        'location_id' => factory(Location::class)->create()->id,
        'department_id' => factory(Department::class)->create()->id,
        'division_id' => factory(Division::class)->create()->id,
        'job_title_id' => factory(JobTitle::class)->create()->id,
        'effective_at' => $this->faker->date('Y-m-d'),
        'comment' => $this->faker->sentence,
    ];
});
