<?php

namespace HRis\PIM\Tests\Eloquents;

use HRis\PIM\Tests\Test;
use HRis\PIM\Eloquent\PayType;
use Symfony\Component\HttpFoundation\Response;

class PayTypeTest extends Test
{
    /** @test */
    public function can_add_a_pay_type()
    {
        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->authApi('POST', 'api/pay-types', $data);

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
    public function can_update_an_existing_pay_type()
    {
        $payType = PayType::factory()->create();

        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->authApi('PATCH', 'api/pay-types/' . $payType->id, $data);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'sort_order',
                    'name',
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $payType->id);
    }

    /** @test */
    public function can_retrieve_a_pay_type()
    {
        $payTypeToRetrieve = PayType::factory()->create();

        $response = $this->authApi('GET', 'api/pay-types/' . $payTypeToRetrieve->id);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'sort_order',
                    'name',
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $payTypeToRetrieve->id);
    }

    /** @test */
    public function can_retrieve_all_pay_types()
    {
        $response = $this->authApi('GET', 'api/pay-types?per_page=all');

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
    public function can_retrieve_paginated_pay_types()
    {
        $response = $this->authApi('GET', 'api/pay-types');

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
    public function can_delete_a_pay_type()
    {
        $payTypeToDelete = PayType::factory()->create();

        $response = $this->authApi('DELETE', 'api/pay-types/' . $payTypeToDelete->id);

        $response->assertStatus(Response::HTTP_OK);
    }
}
