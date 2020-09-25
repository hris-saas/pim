<?php

namespace Database\Factories;

use HRis\PIM\Eloquent\EmploymentStatus;
use HRis\PIM\Eloquent\EmployeeEmploymentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeEmploymentStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmployeeEmploymentStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'employee_id' => null,
            'employment_status_id' => EmploymentStatus::factory()->create()->id,
            'effective_at' => $this->faker->date('Y-m-d'),
            'comment' => $this->faker->sentence,
        ];
    }
}
