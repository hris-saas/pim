<?php

namespace HRis\PIM\Tests\Eloquents;

use HRis\PIM\Tests\Test;
use HRis\PIM\Eloquent\Employee;
use Symfony\Component\HttpFoundation\Response;

class EmployeeTest extends Test
{
    /** @test */
    public function can_add_an_employee()
    {
        $data = [
            'first_name' => $this->faker->firstName,
            'last_name'  => $this->faker->lastName,
        ];

        $response = $this->authApi('POST', 'api/employees', $data);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'uuid',
                    'first_name',
                    'middle_name',
                    'last_name',
                    'salutation',
                    'nickname',
                    'employee_no',
                    'date_of_birth',
                    'identity_no',
                    'gender',
                    'addresses',
                    'work_email',
                    'personal_email',
                    'work_phone',
                    'work_phone_ext',
                    'mobile_phone',
                    'home_phone',
                    'is_active',
                    'started_at',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                ],
            ]);
    }

    /** @test */
    public function can_update_an_existing_employee()
    {
        $employee = Employee::factory()->create();

        $data = [
            'first_name' => $this->faker->firstName,
        ];

        $response = $this->authApi('PATCH', 'api/employees/' . $employee->uuid, $data);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'first_name',
                    'middle_name',
                    'last_name',
                    'salutation',
                    'nickname',
                    'employee_no',
                    'date_of_birth',
                    'identity_no',
                    'gender',
                    'addresses',
                    'work_email',
                    'personal_email',
                    'work_phone',
                    'work_phone_ext',
                    'mobile_phone',
                    'home_phone',
                    'is_active',
                    'started_at',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $employee->id);
        $this->assertEquals($response->getData()->data->first_name, $data['first_name']);
    }

    /** @test */
    public function can_retrieve_an_employee()
    {
        $employeeToRetrieve = Employee::factory()->create();

        $response = $this->authApi('GET', 'api/employees/' . $employeeToRetrieve->uuid);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'first_name',
                    'middle_name',
                    'last_name',
                    'salutation',
                    'nickname',
                    'employee_no',
                    'date_of_birth',
                    'identity_no',
                    'gender',
                    'addresses',
                    'work_email',
                    'personal_email',
                    'work_phone',
                    'work_phone_ext',
                    'mobile_phone',
                    'home_phone',
                    'is_active',
                    'started_at',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $employeeToRetrieve->id);
    }

    /** @test */
    public function can_retrieve_all_employees()
    {
        $response = $this->authApi('GET', 'api/employees?per_page=all');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'first_name',
                        'middle_name',
                        'last_name',
                        'salutation',
                        'nickname',
                        'employee_no',
                        'date_of_birth',
                        'identity_no',
                        'gender',
                        'addresses',
                        'work_email',
                        'personal_email',
                        'work_phone',
                        'work_phone_ext',
                        'mobile_phone',
                        'home_phone',
                        'is_active',
                        'started_at',
                        'created_at',
                        'updated_at',
                        'deleted_at',
                    ],
                ],
            ]);
    }

    /** @test */
    public function can_retrieve_paginated_employees()
    {
        $response = $this->authApi('GET', 'api/employees');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'first_name',
                        'middle_name',
                        'last_name',
                        'salutation',
                        'nickname',
                        'employee_no',
                        'date_of_birth',
                        'identity_no',
                        'gender',
                        'addresses',
                        'work_email',
                        'personal_email',
                        'work_phone',
                        'work_phone_ext',
                        'mobile_phone',
                        'home_phone',
                        'is_active',
                        'started_at',
                        'created_at',
                        'updated_at',
                        'deleted_at',
                    ],
                ],
                'links' => [
                    'first',
                    'last',
                    'prev',
                    'next',
                ],
                'meta' => [
                    'current_page',
                    'from',
                    'last_page',
                    'path',
                    'per_page',
                    'to',
                    'total',
                ],
            ]);
    }

    /** @test */
    public function can_delete_an_employee()
    {
        $employeeToDelete = Employee::factory()->create();

        $response = $this->authApi('DELETE', 'api/employees/' . $employeeToDelete->uuid);

        $response->assertStatus(Response::HTTP_OK);
    }
}
