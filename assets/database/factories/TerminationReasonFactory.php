<?php

namespace Database\Factories;

use HRis\PIM\Eloquent\TerminationReason;
use Illuminate\Database\Eloquent\Factories\Factory;

class TerminationReasonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TerminationReason::class;

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
