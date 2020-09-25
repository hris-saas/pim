<?php

namespace Database\Factories;

use HRis\PIM\Eloquent\Job;
use HRis\PIM\Eloquent\Division;
use HRis\PIM\Eloquent\JobTitle;
use HRis\PIM\Eloquent\Location;
use HRis\PIM\Eloquent\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Job::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'employee_id' => null,
            'location_id' => Location::factory()->create()->id,
            'department_id' => Department::factory()->create()->id,
            'division_id' => Division::factory()->create()->id,
            'job_title_id' => JobTitle::factory()->create()->id,
            'effective_at' => $this->faker->date('Y-m-d'),
            'comment' => $this->faker->sentence,
        ];
    }
}
