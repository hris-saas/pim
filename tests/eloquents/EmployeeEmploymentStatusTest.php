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

        $response = $this->authApi('POST', "api/employees/{$employee->id}/employment-statuses", $data);

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
        $employmentStatus = EmployeeEmploymentStatus::factory()->create([
            'employee_id' => Employee::factory()->create()->id,
        ]);

        $data = [
            'comment' => $this->faker->sentence,
        ];

        $response = $this->authApi('PATCH', "api/employees/{$employmentStatus->employee_id}/employment-statuses/{$employmentStatus->id}", $data);

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
        $employmentStatus = EmployeeEmploymentStatus::factory()->create([
            'employee_id' => Employee::factory()->create()->id,
        ]);

        $response = $this->authApi('GET', "api/employees/{$employmentStatus->employee_id}/employment-statuses/{$employmentStatus->id}");

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
        $employmentStatus = EmployeeEmploymentStatus::factory()->create([
            'employee_id' => Employee::factory()->create()->id,
        ]);

        $response = $this->authApi('GET', "api/employees/{$employmentStatus->employee_id}/employment-statuses");

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
        $employmentStatusToDelete = EmployeeEmploymentStatus::factory()->create([
            'employee_id' => Employee::factory()->create()->id,
        ]);

        $response = $this->authApi('DELETE', "api/employees/{$employmentStatusToDelete->employee_id}/employment-statuses/" . $employmentStatusToDelete->id);

        $response->assertStatus(Response::HTTP_OK);
    }
}
