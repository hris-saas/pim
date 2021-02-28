<?php

namespace HRis\PIM\Tests\Eloquents;

use HRis\PIM\Tests\Test;
use HRis\PIM\Eloquent\Division;
use Symfony\Component\HttpFoundation\Response;

class DivisionTest extends Test
{
    /** @test */
    public function can_add_a_division()
    {
        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->authApi('POST', 'api/divisions', $data);

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
    public function can_update_an_existing_division()
    {
        $division = Division::factory()->create();

        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->authApi('PATCH', 'api/divisions/' . $division->id, $data);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'sort_order',
                    'name',
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $division->id);
    }

    /** @test */
    public function can_retrieve_a_division()
    {
        $divisionToRetrieve = Division::factory()->create();

        $response = $this->authApi('GET', 'api/divisions/' . $divisionToRetrieve->id);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'sort_order',
                    'name',
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $divisionToRetrieve->id);
    }

    /** @test */
    public function can_retrieve_all_divisions()
    {
        $response = $this->authApi('GET', 'api/divisions?per_page=all');

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
    public function can_retrieve_paginated_divisions()
    {
        $response = $this->authApi('GET', 'api/divisions');

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
    public function can_delete_a_division()
    {
        $divisionToDelete = Division::factory()->create();

        $response = $this->authApi('DELETE', 'api/divisions/' . $divisionToDelete->id);

        $response->assertStatus(Response::HTTP_OK);
    }
}
