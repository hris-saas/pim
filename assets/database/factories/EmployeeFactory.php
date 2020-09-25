<?php


namespace Database\Factories;

use HRis\PIM\Eloquent\Employee;
use HRis\PIM\Eloquent\MaritalStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'salutation' => 'Mr.',
            'nickname' => $this->faker->name,
            'employee_no' => $this->faker->randomNumber(),
            'date_of_birth' => $this->faker->date('Y-m-d'),
            'identity_no' => $this->faker->swiftBicNumber,
            'gender' => 'm',
            'marital_status_id' => MaritalStatus::first(),
            'work_email' => $this->faker->safeEmail,
            'personal_email' => $this->faker->safeEmail,
            'work_phone' => $this->faker->phoneNumber,
            'work_phone_ext' => $this->faker->phoneNumber,
            'mobile_phone' => $this->faker->phoneNumber,
            'home_phone' => $this->faker->phoneNumber,
            'is_active' => true,
            'started_at' => $this->faker->dateTimeBetween()->format('Y-m-d'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
