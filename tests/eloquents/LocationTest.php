<?php

namespace HRis\PIM\Tests\Eloquents;

use HRis\PIM\Tests\Test;
use HRis\PIM\Eloquent\Location;
use Symfony\Component\HttpFoundation\Response;

class LocationTest extends Test
{
    /** @test */
    public function can_add_a_location()
    {
        $response = $this->authApi('POST', 'api/locations', self::NAME);

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
    public function cannot_add_or_update_a_department_with_same_name()
    {
        $response = $this->authApi('POST', 'api/locations', self::NAME);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function can_update_an_existing_location()
    {
        $location = Location::factory()->create();

        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->authApi('PATCH', 'api/locations/' . $location->id, $data);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'sort_order',
                    'name',
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $location->id);
    }

    /** @test */
    public function can_retrieve_a_location()
    {
        $locationToRetrieve = Location::factory()->create();

        $response = $this->authApi('GET', 'api/locations/' . $locationToRetrieve->id);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'sort_order',
                    'name',
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $locationToRetrieve->id);
    }

    /** @test */
    public function can_retrieve_all_locations()
    {
        $response = $this->authApi('GET', 'api/locations?per_page=all');

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
    public function can_retrieve_paginated_locations()
    {
        $response = $this->authApi('GET', 'api/locations');

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
    public function can_delete_a_location()
    {
        $locationToDelete = Location::factory()->create();

        $response = $this->authApi('DELETE', 'api/locations/' . $locationToDelete->id);

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function can_restore_a_location()
    {
        $locationToDelete = Location::factory()->create();
        $locationToDelete->delete();

        $response = $this->authApi('PATCH', 'api/locations/' . $locationToDelete->id . '/restore');

        $response->assertStatus(Response::HTTP_OK);
    }
}
