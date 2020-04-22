<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use HRis\PIM\Eloquent\PayType;
use HRis\PIM\Eloquent\Division;
use HRis\PIM\Eloquent\JobTitle;
use HRis\PIM\Eloquent\Location;
use HRis\PIM\Eloquent\PayPeriod;
use HRis\PIM\Eloquent\Department;
use HRis\PIM\Eloquent\Relationship;
use HRis\PIM\Eloquent\MaritalStatus;
use HRis\PIM\Eloquent\EmploymentStatus;
use HRis\PIM\Eloquent\TerminationReason;

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

$factory->define(Department::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(Division::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(JobTitle::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(Location::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(MaritalStatus::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(PayPeriod::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(PayType::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(TerminationReason::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(EmploymentStatus::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});


$factory->define(Relationship::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
