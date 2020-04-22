<?php

namespace HRis\PIM\Tests\Eloquents;

use HRis\PIM\Tests\Test;
use HRis\PIM\Eloquent\MaritalStatus;
use Symfony\Component\HttpFoundation\Response;

class MaritalStatusTest extends Test
{
    /** @test */
    public function can_add_a_marital_status()
    {
        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->authApi('POST', 'api/marital-statuses', $data);

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
    public function can_update_an_existing_marital_status()
    {
        $maritalStatus = factory(MaritalStatus::class)->create();

        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->authApi('PATCH', 'api/marital-statuses/' . $maritalStatus->id, $data);

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

        $this->assertEquals($response->getData()->data->id, $maritalStatus->id);
    }

    /** @test */
    public function can_retrieve_a_marital_status()
    {
        $maritalStatusToRetrieve = factory(MaritalStatus::class)->create();

        $response = $this->authApi('GET', 'api/marital-statuses/' . $maritalStatusToRetrieve->id);

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

        $this->assertEquals($response->getData()->data->id, $maritalStatusToRetrieve->id);
    }

    /** @test */
    public function can_retrieve_all_marital_statuss()
    {
        $response = $this->authApi('GET', 'api/marital-statuses?per_page=all');

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
    public function can_retrieve_paginated_marital_statuss()
    {
        $response = $this->authApi('GET', 'api/marital-statuses');

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
    public function can_delete_a_marital_status()
    {
        $maritalStatusToDelete = factory(MaritalStatus::class)->create();

        $response = $this->authApi('DELETE', 'api/marital-statuses/' . $maritalStatusToDelete->id);

        $response->assertStatus(Response::HTTP_OK);
    }
}
