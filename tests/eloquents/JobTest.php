<?php

namespace HRis\PIM\Tests\Eloquents;

use HRis\PIM\Tests\Test;
use HRis\PIM\Eloquent\Job;
use HRis\PIM\Eloquent\Division;
use HRis\PIM\Eloquent\Employee;
use HRis\PIM\Eloquent\JobTitle;
use HRis\PIM\Eloquent\Location;
use HRis\PIM\Eloquent\Department;
use Symfony\Component\HttpFoundation\Response;

class JobTest extends Test
{
    /** @test */
    public function can_add_an_employee_job()
    {
        $employee = Employee::factory()->create();

        $data = [
            'location_id' => Location::factory()->create()->id,
            'department_id' => Department::factory()->create()->id,
            'division_id' => Division::factory()->create()->id,
            'job_title_id' => JobTitle::factory()->create()->id,
            'effective_at' => $this->faker->date('Y-m-d'),
            'comment' => $this->faker->sentence,
        ];

        $response = $this->authApi('POST', "api/employees/{$employee->uuid}/jobs", $data);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'user_id',
                    'location',
                    'department',
                    'division',
                    'job_title',
                    'effective_at',
                    'comment',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                ],
            ]);
    }

    /** @test */
    public function can_update_an_existing_employee_job()
    {
        $employee = Employee::factory()->create();

        $job = Job::factory()->create([
            'employee_id' => $employee->id,
        ]);

        $data = [
            'comment' => $this->faker->sentence,
        ];

        $response = $this->authApi('PATCH', "api/employees/{$employee->uuid}/jobs/{$job->id}", $data);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'user_id',
                    'location',
                    'department',
                    'division',
                    'job_title',
                    'effective_at',
                    'comment',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $job->id);
        $this->assertEquals($response->getData()->data->comment, $data['comment']);
    }

    /** @test */
    public function can_retrieve_an_employee_job()
    {
        $employee = Employee::factory()->create();

        $job = Job::factory()->create([
            'employee_id' => $employee->id,
        ]);

        $response = $this->authApi('GET', "api/employees/{$employee->uuid}/jobs/{$job->id}");

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'user_id',
                    'location',
                    'department',
                    'division',
                    'job_title',
                    'effective_at',
                    'comment',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $job->id);
    }

    /** @test */
    public function can_retrieve_all_employee_jobs()
    {
        $employee = Employee::factory()->create();

        $job = Job::factory()->create([
            'employee_id' => $employee->id,
        ]);

        $response = $this->authApi('GET', "api/employees/{$employee->uuid}/jobs");

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'user_id',
                        'location',
                        'department',
                        'division',
                        'job_title',
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
    public function can_delete_an_employee_job()
    {
        $employee = Employee::factory()->create();

        $jobToDelete = Job::factory()->create([
            'employee_id' => $employee->id,
        ]);

        $response = $this->authApi('DELETE', "api/employees/{$employee->uuid}/jobs/" . $jobToDelete->id);

        $response->assertStatus(Response::HTTP_OK);
    }
}
