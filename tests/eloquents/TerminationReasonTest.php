<?php

namespace HRis\PIM\Tests\Eloquents;

use HRis\PIM\Tests\Test;
use HRis\PIM\Eloquent\TerminationReason;
use Symfony\Component\HttpFoundation\Response;

class TerminationReasonTest extends Test
{
    /** @test */
    public function can_add_a_termination_reason()
    {
        $response = $this->authApi('POST', 'api/termination-reasons', self::NAME);

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
        $response = $this->authApi('POST', 'api/termination-reasons', self::NAME);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function can_update_an_existing_termination_reason()
    {
        $terminationReason = TerminationReason::factory()->create();

        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->authApi('PATCH', 'api/termination-reasons/' . $terminationReason->id, $data);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'sort_order',
                    'name',
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $terminationReason->id);
    }

    /** @test */
    public function can_retrieve_a_termination_reason()
    {
        $terminationReasonToRetrieve = TerminationReason::factory()->create();

        $response = $this->authApi('GET', 'api/termination-reasons/' . $terminationReasonToRetrieve->id);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'sort_order',
                    'name',
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $terminationReasonToRetrieve->id);
    }

    /** @test */
    public function can_retrieve_all_termination_reasons()
    {
        $response = $this->authApi('GET', 'api/termination-reasons?per_page=all');

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
    public function can_retrieve_paginated_termination_reasons()
    {
        $response = $this->authApi('GET', 'api/termination-reasons');

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
    public function can_delete_a_termination_reason()
    {
        $terminationReasonToDelete = TerminationReason::factory()->create();

        $response = $this->authApi('DELETE', 'api/termination-reasons/' . $terminationReasonToDelete->id);

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function can_restore_a_termination_reason()
    {
        $terminationReasonToDelete = TerminationReason::factory()->create();
        $terminationReasonToDelete->delete();

        $response = $this->authApi('PATCH', 'api/termination-reasons/' . $terminationReasonToDelete->id . '/restore');

        $response->assertStatus(Response::HTTP_OK);
    }
}
