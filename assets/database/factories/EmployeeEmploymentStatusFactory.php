<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use HRis\PIM\Eloquent\EmploymentStatus;
use HRis\PIM\Eloquent\EmployeeEmploymentStatus;

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

$factory->define(EmployeeEmploymentStatus::class, function (Faker $faker) {
    return [
        'employee_id' => null,
        'employment_status_id' => factory(EmploymentStatus::class)->create()->id,
        'effective_at' => $this->faker->date('Y-m-d'),
        'comment' => $this->faker->sentence,
    ];
});
