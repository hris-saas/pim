<?php

namespace Database\Factories;

use HRis\PIM\Eloquent\MaritalStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaritalStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MaritalStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
        ];
    }
}
