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
        $employee = factory(Job::class)->create();

        $data = [
            'location_id' => factory(Location::class)->create()->id,
            'department_id' => factory(Department::class)->create()->id,
            'division_id' => factory(Division::class)->create()->id,
            'job_title_id' => factory(JobTitle::class)->create()->id,
            'effective_at' => $this->faker->date('Y-m-d'),
            'comment' => $this->faker->sentence,
        ];

        $response = $this->authApi('POST', "api/employees/{$employee->id}/jobs", $data);

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
        $job = factory(Job::class)->create([
            'employee_id' => factory(Employee::class)->create()->id,
        ]);

        $data = [
            'comment' => $this->faker->sentence,
        ];

        $response = $this->authApi('PATCH', "api/employees/{$job->employee_id}/jobs/{$job->id}", $data);

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
        $job = factory(Job::class)->create([
            'employee_id' => factory(Employee::class)->create()->id,
        ]);

        $response = $this->authApi('GET', "api/employees/{$job->employee_id}/jobs/{$job->id}");

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
        $job = factory(Job::class)->create([
            'employee_id' => factory(Employee::class)->create()->id,
        ]);

        $response = $this->authApi('GET', "api/employees/{$job->employee_id}/jobs");

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
        $jobToDelete = factory(Job::class)->create([
            'employee_id' => factory(Employee::class)->create()->id,
        ]);

        $response = $this->authApi('DELETE', "api/employees/{$jobToDelete->employee_id}/jobs/" . $jobToDelete->id);

        $response->assertStatus(Response::HTTP_OK);
    }
}
