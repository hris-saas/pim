<?php

namespace HRis\PIM\Tests\Eloquents;

use HRis\PIM\Tests\Test;
use HRis\PIM\Eloquent\Relationship;
use Symfony\Component\HttpFoundation\Response;

class RelationshipTest extends Test
{
    /** @test */
    public function can_add_a_relationship()
    {
        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->authApi('POST', 'api/relationships', $data);

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
    public function can_update_an_existing_relationship()
    {
        $relationship = Relationship::factory()->create();

        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->authApi('PATCH', 'api/relationships/' . $relationship->id, $data);

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

        $this->assertEquals($response->getData()->data->id, $relationship->id);
    }

    /** @test */
    public function can_retrieve_a_relationship()
    {
        $relationshipToRetrieve = Relationship::factory()->create();

        $response = $this->authApi('GET', 'api/relationships/' . $relationshipToRetrieve->id);

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

        $this->assertEquals($response->getData()->data->id, $relationshipToRetrieve->id);
    }

    /** @test */
    public function can_retrieve_all_relationships()
    {
        $response = $this->authApi('GET', 'api/relationships?per_page=all');

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
    public function can_retrieve_paginated_relationships()
    {
        $response = $this->authApi('GET', 'api/relationships');

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
    public function can_delete_a_relationship()
    {
        $relationshipToDelete = Relationship::factory()->create();

        $response = $this->authApi('DELETE', 'api/relationships/' . $relationshipToDelete->id);

        $response->assertStatus(Response::HTTP_OK);
    }
}
