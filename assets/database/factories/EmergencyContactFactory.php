<?php

namespace Database\Factories;

use HRis\PIM\Eloquent\Relationship;
use HRis\PIM\Eloquent\EmergencyContact;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmergencyContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmergencyContact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'full_name' => $this->faker->name,
            'relationship_id' => Relationship::factory()->create()->id,
            'home_phone' => $this->faker->phoneNumber,
            'mobile_phone' => $this->faker->phoneNumber,
            'email' => $this->faker->safeEmail,
            'address' => $this->faker->address,
            'is_primary' => true,
        ];
    }
}
