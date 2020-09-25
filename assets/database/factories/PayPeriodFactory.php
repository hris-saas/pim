<?php

namespace Database\Factories;

use HRis\PIM\Eloquent\PayPeriod;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayPeriodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PayPeriod::class;

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
