<?php

namespace HRis\PIM\Tests\Eloquents;

use HRis\PIM\Tests\Test;
use HRis\PIM\Eloquent\Employee;
use HRis\PIM\Eloquent\EmploymentStatus;
use Symfony\Component\HttpFoundation\Response;
use HRis\PIM\Eloquent\EmployeeEmploymentStatus;

class EmployeeEmploymentStatusTest extends Test
{
    /** @test */
    public function can_add_an_employee_employment_status()
    {
        $employee = Employee::factory()->create();

        $data = [
            'employment_status_id' => EmploymentStatus::factory()->create()->id,
            'effective_at' => $this->faker->date('Y-m-d'),
            'comment' => $this->faker->sentence,
        ];

        $response = $this->authApi('POST', "api/employees/{$employee->uuid}/employment-statuses", $data);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'user_id',
                    'employment_status',
                    'effective_at',
                    'comment',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                ],
            ]);
    }

    /** @test */
    public function can_update_an_existing_employee_employment_status()
    {
        $employee = Employee::factory()->create();

        $employmentStatus = EmployeeEmploymentStatus::factory()->create([
            'employee_id' => $employee->id,
        ]);

        $data = [
            'comment' => $this->faker->sentence,
        ];

        $response = $this->authApi('PATCH', "api/employees/{$employee->uuid}/employment-statuses/{$employmentStatus->id}", $data);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'user_id',
                    'employment_status',
                    'effective_at',
                    'comment',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $employmentStatus->id);
        $this->assertEquals($response->getData()->data->comment, $data['comment']);
    }

    /** @test */
    public function can_retrieve_an_employee_employment_status()
    {
        $employee = Employee::factory()->create();

        $employmentStatus = EmployeeEmploymentStatus::factory()->create([
            'employee_id' => $employee->id,
        ]);

        $response = $this->authApi('GET', "api/employees/{$employee->uuid}/employment-statuses/{$employmentStatus->id}");

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'user_id',
                    'employment_status',
                    'effective_at',
                    'comment',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $employmentStatus->id);
    }

    /** @test */
    public function can_retrieve_all_employee_employment_statuses()
    {
        $employee = Employee::factory()->create();

        $employmentStatus = EmployeeEmploymentStatus::factory()->create([
            'employee_id' => $employee->id,
        ]);

        $response = $this->authApi('GET', "api/employees/{$employee->uuid}/employment-statuses");

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'user_id',
                        'employment_status',
                        'effective_at',
                        'comment',
                        'created_at',
                        'updated_at',
                        'deleted_at',
                    ],
                ],
            ]);
    }

    /** @test */
    public function can_delete_an_employee_employment_status()
    {
        $employee = Employee::factory()->create();

        $employmentStatusToDelete = EmployeeEmploymentStatus::factory()->create([
            'employee_id' => $employee->id,
        ]);

        $response = $this->authApi('DELETE', "api/employees/{$employee->uuid}/employment-statuses/" . $employmentStatusToDelete->id);

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function can_get_employee_employment_status_related_models()
    {
        $this->createUser();
        $employee = Employee::factory()->create();

        $employmentStatus = EmployeeEmploymentStatus::factory()->create([
            'user_id'     => 1,
            'employee_id' => $employee->id,
        ]);

        $this->assertEquals($employmentStatus->user->id, 1);
        $this->assertEquals($employmentStatus->employee->id, $employee->id);
    }
}
