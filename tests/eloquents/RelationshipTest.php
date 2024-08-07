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
        $response = $this->authApi('POST', 'api/relationships', self::NAME);

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
    public function cannot_add_or_update_a_relationship_with_same_name()
    {
        $data = [
            'name' => ['nl' => self::NAME],
        ];

        Relationship::create($data);

        $response = $this->authApi('POST', 'api/relationships', self::NAME);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
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
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $relationshipToRetrieve->id);
    }

    /** @test */
    public function can_retrieve_all_relationships()
    {
        Relationship::factory(5)->create();

        $response = $this->authApi('GET', 'api/relationships?per_page=all');

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
    public function can_retrieve_all_relationships_for_select()
    {
        Relationship::factory(5)->create();

        $response = $this->authApi('GET', 'api/relationships?isSelect');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'name',
                    ],
                ],
            ]);
    }

    /** @test */
    public function can_retrieve_paginated_relationships()
    {
        Relationship::factory(5)->create();

        $response = $this->authApi('GET', 'api/relationships');

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
    public function can_delete_a_relationship()
    {
        $relationshipToDelete = Relationship::factory()->create();

        $response = $this->authApi('DELETE', 'api/relationships/' . $relationshipToDelete->id);

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function can_restore_a_relationship()
    {
        $relationshipToDelete = Relationship::factory()->create();
        $relationshipToDelete->delete();

        $response = $this->authApi('PATCH', 'api/relationships/' . $relationshipToDelete->id . '/restore');

        $response->assertStatus(Response::HTTP_OK);
    }
}
