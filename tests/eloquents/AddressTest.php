<?php

namespace HRis\PIM\Tests\Eloquents;

use HRis\PIM\Tests\Test;
use HRis\PIM\Eloquent\Address;
use HRis\PIM\Eloquent\Employee;
use Symfony\Component\HttpFoundation\Response;

class AddressTest extends Test
{
    /** @test */
    public function can_add_an_employee_address()
    {
        $employee = Employee::factory()->create();

        $data = [
            'address_1' => $this->faker->streetAddress,
            'address_2' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'postal_code' => $this->faker->postcode,
            'country' => $this->faker->country,
        ];

        $response = $this->authApi('POST', "api/employees/{$employee->uuid}/addresses", $data);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'address_1',
                    'address_2',
                    'city',
                    'state',
                    'postal_code',
                    'country',
                ],
            ]);
    }

    /** @test */
    public function can_update_an_existing_employee_address()
    {
        $employee = Employee::factory()->create();

        $address = Address::factory()->create([
            'employee_id' => $employee->id,
        ]);

        $data = [
            'address_1' => $this->faker->streetAddress,
        ];

        $response = $this->authApi('PATCH', "api/employees/{$employee->uuid}/addresses/{$address->id}", $data);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'address_1',
                    'address_2',
                    'city',
                    'state',
                    'postal_code',
                    'country',
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $address->id);
        $this->assertEquals($response->getData()->data->address_1, $data['address_1']);
    }

    /** @test */
    public function can_retrieve_an_employee_address()
    {
        $employee = Employee::factory()->create();

        $address = Address::factory()->create([
            'employee_id' => $employee->id,
        ]);

        $response = $this->authApi('GET', "api/employees/{$employee->uuid}/addresses/{$address->id}");

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'address_1',
                    'address_2',
                    'city',
                    'state',
                    'postal_code',
                    'country',
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $address->id);
    }

    /** @test */
    public function can_retrieve_all_employee_addresses()
    {
        $employee = Employee::factory()->create();

        $address = Address::factory()->create([
            'employee_id' => $employee->id,
        ]);

        $response = $this->authApi('GET', "api/employees/{$employee->uuid}/addresses");

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'address_1',
                        'address_2',
                        'city',
                        'state',
                        'postal_code',
                        'country',
                    ],
                ],
            ]);
    }

    /** @test */
    public function can_delete_an_employee_address()
    {
        $employee = Employee::factory()->create();

        $addressToDelete = Address::factory()->create([
            'employee_id' => $employee->id,
        ]);

        $response = $this->authApi('DELETE', "api/employees/{$employee->uuid}/addresses/" . $addressToDelete->id);

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function can_get_employee_address_related_models()
    {
        $employee = Employee::factory()->create();

        $address = Address::factory()->create([
            'employee_id'   => $employee->id,
        ]);

        $this->assertEquals($address->employee->id, $employee->id);
    }
}
