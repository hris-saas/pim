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
        $employee = factory(Employee::class)->create();

        $data = [
            'address_1' => $this->faker->streetAddress,
            'address_2' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'postal_code' => $this->faker->postcode,
            'country' => $this->faker->country,
        ];

        $response = $this->authApi('POST', "api/employees/{$employee->id}/addresses", $data);

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
        $address = factory(Address::class)->create([
            'employee_id' => factory(Employee::class)->create()->id,
        ]);

        $data = [
            'address_1' => $this->faker->streetAddress,
        ];

        $response = $this->authApi('PATCH', "api/employees/{$address->employee_id}/addresses/{$address->id}", $data);

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
        $address = factory(Address::class)->create([
            'employee_id' => factory(Employee::class)->create()->id,
        ]);

        $response = $this->authApi('GET', "api/employees/{$address->employee_id}/addresses/{$address->id}");

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
        $address = factory(Address::class)->create([
            'employee_id' => factory(Employee::class)->create()->id,
        ]);

        $response = $this->authApi('GET', "api/employees/{$address->employee_id}/addresses");

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
        $addressToDelete = factory(Address::class)->create([
            'employee_id' => factory(Employee::class)->create()->id,
        ]);

        $response = $this->authApi('DELETE', "api/employees/{$addressToDelete->employee_id}/addresses/" . $addressToDelete->id);

        $response->assertStatus(Response::HTTP_OK);
    }
}
