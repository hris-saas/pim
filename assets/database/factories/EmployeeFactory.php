<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use HRis\PIM\Eloquent\Employee;
use HRis\PIM\Eloquent\MaritalStatus;

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

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'middle_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'salutation' => 'Mr.',
        'nickname' => $faker->name,
        'employee_no' => $faker->randomNumber(),
        'date_of_birth' => $faker->date('Y-m-d'),
        'identity_no' => $faker->swiftBicNumber,
        'gender' => 'm',
        'marital_status_id' => MaritalStatus::first(),
        'work_email' => $faker->safeEmail,
        'personal_email' => $faker->safeEmail,
        'work_phone' => $faker->phoneNumber,
        'work_phone_ext' => $faker->phoneNumber,
        'mobile_phone' => $faker->phoneNumber,
        'home_phone' => $faker->phoneNumber,
        'is_active' => true,
        'started_at' => $faker->dateTimeBetween()->format('Y-m-d'),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
