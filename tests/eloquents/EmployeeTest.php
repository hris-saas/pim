<?php

namespace HRis\PIM\Tests\Eloquents;

use HRis\PIM\Tests\Test;
use HRis\PIM\Eloquent\Address;
use HRis\PIM\Eloquent\PayType;
use HRis\PIM\Eloquent\Employee;
use HRis\PIM\Eloquent\JobTitle;
use HRis\PIM\Eloquent\Location;
use HRis\PIM\Eloquent\PayPeriod;
use HRis\PIM\Eloquent\ChangeReason;
use HRis\PIM\Eloquent\MaritalStatus;
use HRis\PIM\Eloquent\EmploymentStatus;
use Symfony\Component\HttpFoundation\Response;

class EmployeeTest extends Test
{
    /** @test */
    public function can_add_an_employee()
    {
        $data = [
            'first_name'           => $this->faker->firstName,
            'last_name'            => $this->faker->lastName,
            'gender'               => 'm',
            'department_id'        => null,
            'location_id'          => Location::factory()->create()->id,
            'job_title_id'         => JobTitle::factory()->create()->id,
            'is_active'            => true,
            'marital_status_id'    => MaritalStatus::factory()->create()->id,
            'employment_status_id' => EmploymentStatus::factory()->create()->id,
            'employee_no'          => $this->faker->word,
            'date_of_birth' => [
                'day'   => rand(1, 31),
                'month' => rand(1, 12),
                'year'  => '2000',
            ],
            'date_of_start' => [
                'day'   => rand(1, 31),
                'month' => rand(1, 12),
                'year'  => '2000',
            ],
            'addresses' => [
                [
                    'address_1' => $this->faker->streetAddress(),
                    'city'      => $this->faker->city(),
                    'country'   => $this->faker->country(),
                ],
            ],
            'mobile_phone'     => $this->faker->e164PhoneNumber(),
            'work_email'       => $this->faker->safeEmail(),
            'pay_value'        => 1000,
            'pay_rate'         => 'year',
            'currency'         => 'usd',
            'pay_type_id'      => PayType::factory()->create()->id,
            'pay_period_id'    => PayPeriod::factory()->create()->id,
            'change_reason_id' => ChangeReason::factory()->create()->id,
            'is_ess_on'        => true,
        ];

        $response = $this->authApi('POST', 'api/employees', $data);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'data' => [
                    'uuid',
                    'first_name',
                    'last_name',
                    'employee_no',
                    'date_of_birth',
                    'employee_no',
                    'gender',
                    'addresses',
                    'work_email',
                    'mobile_phone',
                    'is_active',
                    'started_at',
                    'created_at',
                    'updated_at',
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
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $employeeToRetrieve->id);
    }

    /** @test */
    public function can_retrieve_all_employees()
    {
        Employee::factory(5)->create();

        foreach (range(0, 4) as $key => $item) {
            Address::factory(5)->create(['employee_id' => $key + 1]);
        }

        $response = $this->authApi('GET', 'api/employees?per_page=all');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    [
                        'uuid',
                        'first_name',
                        'middle_name',
                        'last_name',
                        'salutation',
                        'nickname',
                        'employee_no',
                        'date_of_birth',
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
                    ],
                ],
            ]);
    }

    /** @test */
    public function can_retrieve_paginated_employees()
    {
        Employee::factory(5)->create();

        foreach (range(0, 4) as $key => $item) {
            Address::factory(5)->create(['employee_id' => $key + 1]);
        }

        $response = $this->authApi('GET', 'api/employees');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    [
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

    /** @test */
    public function can_get_employee_related_models()
    {
        $employee = Employee::factory()->create();

        $directReport = Employee::factory()->create([
            'reports_to_id' => $employee->id,
        ]);

        $indirectReport = Employee::factory()->create([
            'reports_to_id' => $directReport->id,
        ]);

        $employee = $employee->fresh();
        $directReportIds = $employee->directReports()->pluck('id')->toArray();
        $indirectReportIds = $employee->indirectReports()->pluck('id')->toArray();

        $this->assertContains($directReport->id, $directReportIds);
        $this->assertContains($indirectReport->id, $indirectReportIds);
    }

    /** @test */
    public function can_not_add_employee_with_department_id_does_not_exists()
    {
        $data = [
            'first_name' => $this->faker->firstName,
            'last_name'  => $this->faker->lastName,
            'department_id' => 1001,
        ];

        $response = $this->authApi('POST', 'api/employees', $data);

        $response->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'department_id',
                ],
            ]);
    }

    /** @test */
    public function can_get_employee_direct_reports()
    {
        $employee = Employee::factory()->create();

        $directReport = Employee::factory()->create([
            'reports_to_id' => $employee->id,
        ]);

        $response = $this->authApi('GET', 'api/employees/' . $employee->uuid . '/direct-reports');

        $response->assertStatus(200)
            ->assertJsonStructure([

                'data' => [
                    [
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
    public function can_get_employee_indirect_reports()
    {
        $employee = Employee::factory()->create();

        $directReport = Employee::factory()->create([
            'reports_to_id' => $employee->id,
        ]);

        Employee::factory()->create([
            'reports_to_id' => $directReport->id,
        ]);

        $response = $this->authApi('GET', 'api/employees/' . $employee->uuid . '/indirect-reports');

        $response->assertStatus(200)
            ->assertJsonStructure([

                'data' => [
                    [
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
    public function can_get_employee_for_directory()
    {
        Employee::factory(5)->create();

        $response = $this->authApi('GET', 'api/employees?isSelect&orderBy=last_name&groupBy=last_name');

        $response->assertStatus(200);
    }

    /** @test */
    public function can_get_all_employees_with_status()
    {
        Employee::factory(5)->create();

        $response = $this->authApi('GET', 'api/employees?status=1');

        $response->assertStatus(200);
    }
}
