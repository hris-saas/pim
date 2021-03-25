<?php

namespace HRis\PIM\Tests\Eloquents;

use HRis\PIM\Tests\Test;
use HRis\PIM\Eloquent\ChangeReason;
use Symfony\Component\HttpFoundation\Response;

class ChangeReasonTest extends Test
{
    /** @test */
    public function can_add_a_change_reason()
    {
        $response = $this->authApi('POST', 'api/change-reasons', self::NAME);

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
    public function cannot_add_or_update_a_change_reason_with_same_name()
    {
        $response = $this->authApi('POST', 'api/change-reasons', self::NAME);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function can_update_an_existing_change_reason()
    {
        $changeReason = ChangeReason::factory()->create();

        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->authApi('PATCH', 'api/change-reasons/' . $changeReason->id, $data);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'sort_order',
                    'name',
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $changeReason->id);
    }

    /** @test */
    public function can_retrieve_a_change_reason()
    {
        $changeReasonToRetrieve = ChangeReason::factory()->create();

        $response = $this->authApi('GET', 'api/change-reasons/' . $changeReasonToRetrieve->id);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'sort_order',
                    'name',
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $changeReasonToRetrieve->id);
    }

    /** @test */
    public function can_retrieve_all_change_reasons()
    {
        $response = $this->authApi('GET', 'api/change-reasons?per_page=all');

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
    public function can_retrieve_all_change_reasons_for_select()
    {
        $response = $this->authApi('GET', 'api/change-reasons?isSelect');

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
    public function can_retrieve_paginated_change_reasons()
    {
        $response = $this->authApi('GET', 'api/change-reasons');

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
    public function can_delete_a_change_reason()
    {
        $changeReasonToDelete = ChangeReason::factory()->create();

        $response = $this->authApi('DELETE', 'api/change-reasons/' . $changeReasonToDelete->id);

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function can_restore_a_change_reason()
    {
        $changeReasonToDelete = ChangeReason::factory()->create();
        $changeReasonToDelete->delete();

        $response = $this->authApi('PATCH', 'api/change-reasons/' . $changeReasonToDelete->id . '/restore');

        $response->assertStatus(Response::HTTP_OK);
    }
}
