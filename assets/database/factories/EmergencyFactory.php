<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use HRis\PIM\Eloquent\Relationship;
use HRis\PIM\Eloquent\EmergencyContact;

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

$factory->define(EmergencyContact::class, function (Faker $faker) {
    return [
        'full_name' => $this->faker->name,
        'relationship_id' => factory(Relationship::class)->create()->id,
        'home_phone' => $this->faker->phoneNumber,
        'mobile_phone' => $this->faker->phoneNumber,
        'email' => $this->faker->safeEmail,
        'address' => $this->faker->address,
        'is_primary' => true,
    ];
});
