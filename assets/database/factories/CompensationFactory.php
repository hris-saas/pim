<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use HRis\Auth\Eloquent\User;
use Faker\Generator as Faker;
use HRis\PIM\Eloquent\PayType;
use HRis\PIM\Eloquent\Employee;
use HRis\PIM\Eloquent\PayPeriod;
use HRis\PIM\Eloquent\Compensation;

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

$factory->define(Compensation::class, function (Faker $faker) {
    return [
        'employee_id' => factory(Employee::class)->create()->id,
        'effective_at' => now(),
        'pay' => rand(1000, 99999),
        'rate' => rand(10, 99),
        'pay_type_id' => factory(PayType::class)->create()->id,
        'pay_period_id' => factory(PayPeriod::class)->create()->id,
        'currency' => $faker->currencyCode,
        'comment' => $faker->text
    ];
});
