<?php

namespace HRis\PIM\Tests\Eloquents;

use HRis\PIM\Tests\Test;
use HRis\PIM\Eloquent\PayPeriod;
use Symfony\Component\HttpFoundation\Response;

class PayPeriodTest extends Test
{
    /** @test */
    public function can_add_a_pay_period()
    {
        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->authApi('POST', 'api/pay-periods', $data);

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
    public function can_update_an_existing_pay_period()
    {
        $payPeriod = PayPeriod::factory()->create();

        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->authApi('PATCH', 'api/pay-periods/' . $payPeriod->id, $data);

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

        $this->assertEquals($response->getData()->data->id, $payPeriod->id);
    }

    /** @test */
    public function can_retrieve_a_pay_period()
    {
        $payPeriodToRetrieve = PayPeriod::factory()->create();

        $response = $this->authApi('GET', 'api/pay-periods/' . $payPeriodToRetrieve->id);

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

        $this->assertEquals($response->getData()->data->id, $payPeriodToRetrieve->id);
    }

    /** @test */
    public function can_retrieve_all_pay_periods()
    {
        $response = $this->authApi('GET', 'api/pay-periods?per_page=all');

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
    public function can_retrieve_paginated_pay_periods()
    {
        $response = $this->authApi('GET', 'api/pay-periods');

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
    public function can_delete_a_pay_period()
    {
        $payPeriodToDelete = PayPeriod::factory()->create();

        $response = $this->authApi('DELETE', 'api/pay-periods/' . $payPeriodToDelete->id);

        $response->assertStatus(Response::HTTP_OK);
    }
}
