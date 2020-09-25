<?php

namespace Database\Factories;

use HRis\PIM\Eloquent\PayType;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PayType::class;

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
