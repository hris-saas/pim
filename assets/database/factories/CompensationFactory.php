<?php

namespace Database\Factories;

use HRis\PIM\Eloquent\PayType;
use HRis\PIM\Eloquent\Employee;
use HRis\PIM\Eloquent\PayPeriod;
use HRis\PIM\Eloquent\Compensation;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompensationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Compensation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'employee_id' => Employee::factory()->create()->id,
            'effective_at' => now(),
            'pay' => rand(1000, 99999),
            'rate' => rand(10, 99),
            'pay_type_id' => PayType::factory()->create()->id,
            'pay_period_id' => PayPeriod::factory()->create()->id,
            'currency' => $this->faker->currencyCode,
            'comment' => $this->faker->text,
        ];
    }
}
