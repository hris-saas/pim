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
        $response = $this->authApi('POST', 'api/pay-periods', self::NAME);

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
    public function cannot_add_or_update_a_pay_period_with_same_name()
    {
        $data = [
            'name' => ['nl' => self::NAME],
        ];

        PayPeriod::create($data);

        $response = $this->authApi('POST', 'api/pay-periods', self::NAME);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
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
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $payPeriodToRetrieve->id);
    }

    /** @test */
    public function can_retrieve_all_pay_periods()
    {
        PayPeriod::factory(5)->create();

        $response = $this->authApi('GET', 'api/pay-periods?per_page=all');

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
    public function can_retrieve_all_pay_periods_for_select()
    {
        PayPeriod::factory(5)->create();

        $response = $this->authApi('GET', 'api/pay-periods?isSelect');

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
    public function can_retrieve_paginated_pay_periods()
    {
        PayPeriod::factory(5)->create();

        $response = $this->authApi('GET', 'api/pay-periods');

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
    public function can_delete_a_pay_period()
    {
        $payPeriodToDelete = PayPeriod::factory()->create();

        $response = $this->authApi('DELETE', 'api/pay-periods/' . $payPeriodToDelete->id);

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function can_restore_a_pay_period()
    {
        $payPeriodToDelete = PayPeriod::factory()->create();
        $payPeriodToDelete->delete();

        $response = $this->authApi('PATCH', 'api/pay-periods/' . $payPeriodToDelete->id . '/restore');

        $response->assertStatus(Response::HTTP_OK);
    }
}
