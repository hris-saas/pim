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
                ],
            ]);
    }

    /** @test */
    public function can_update_an_existing_marital_status()
    {
        $maritalStatus = MaritalStatus::factory()->create();

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
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $maritalStatus->id);
    }

    /** @test */
    public function can_retrieve_a_marital_status()
    {
        $maritalStatusToRetrieve = MaritalStatus::factory()->create();

        $response = $this->authApi('GET', 'api/marital-statuses/' . $maritalStatusToRetrieve->id);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'sort_order',
                    'name',
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
        $maritalStatusToDelete = MaritalStatus::factory()->create();

        $response = $this->authApi('DELETE', 'api/marital-statuses/' . $maritalStatusToDelete->id);

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function can_restore_a_marital_status()
    {
        $maritalStatusToDelete = MaritalStatus::factory()->create();
        $maritalStatusToDelete->delete();

        $response = $this->authApi('PATCH', 'api/marital-statuses/' . $maritalStatusToDelete->id . '/restore');

        $response->assertStatus(Response::HTTP_OK);
    }
}
