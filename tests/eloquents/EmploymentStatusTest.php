<?php

namespace HRis\PIM\Tests\Eloquents;

use HRis\PIM\Tests\Test;
use HRis\PIM\Eloquent\EmploymentStatus;
use Symfony\Component\HttpFoundation\Response;

class EmploymentStatusTest extends Test
{
    /** @test */
    public function can_add_a_employment_status()
    {
        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->authApi('POST', 'api/employment-statuses', $data);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'sort_order',
                    'name',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                ],
            ]);
    }

    /** @test */
    public function can_update_an_existing_employment_status()
    {
        $employmentStatus = EmploymentStatus::factory()->create();

        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->authApi('PATCH', 'api/employment-statuses/' . $employmentStatus->id, $data);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'sort_order',
                    'name',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $employmentStatus->id);
    }

    /** @test */
    public function can_retrieve_a_employment_status()
    {
        $employmentStatusToRetrieve = EmploymentStatus::factory()->create();

        $response = $this->authApi('GET', 'api/employment-statuses/' . $employmentStatusToRetrieve->id);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'sort_order',
                    'name',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $employmentStatusToRetrieve->id);
    }

    /** @test */
    public function can_retrieve_all_employment_statuss()
    {
        $response = $this->authApi('GET', 'api/employment-statuses?per_page=all');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'sort_order',
                        'name',
                        'created_at',
                        'updated_at',
                        'deleted_at',
                    ],
                ],
            ]);
    }

    /** @test */
    public function can_retrieve_paginated_employment_statuss()
    {
        $response = $this->authApi('GET', 'api/employment-statuses');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'sort_order',
                        'name',
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
    public function can_delete_a_employment_status()
    {
        $employmentStatusToDelete = EmploymentStatus::factory()->create();

        $response = $this->authApi('DELETE', 'api/employment-statuses/' . $employmentStatusToDelete->id);

        $response->assertStatus(Response::HTTP_OK);
    }
}
