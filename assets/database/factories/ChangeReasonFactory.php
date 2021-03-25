<?php

namespace Database\Factories;

use HRis\PIM\Eloquent\ChangeReason;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChangeReasonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ChangeReason::class;

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
