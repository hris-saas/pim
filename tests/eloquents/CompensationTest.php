<?php

namespace HRis\PIM\Tests\Eloquents;

use HRis\PIM\Tests\Test;
use HRis\PIM\Eloquent\PayType;
use HRis\PIM\Eloquent\Employee;
use HRis\PIM\Eloquent\PayPeriod;
use HRis\PIM\Eloquent\Compensation;
use Symfony\Component\HttpFoundation\Response;

class CompensationTest extends Test
{
    /** @test */
    public function can_add_an_employee_compensation()
    {
        $employee = Employee::factory()->create();

        $data = [
            'user' => $employee->id,
            'effective_at' => $this->faker->date('Y-m-d'),
            'pay' => rand(1000, 99999),
            'rate' => rand(10, 99),
            'pay_type_id' => PayType::factory()->create()->id,
            'pay_period_id' => PayPeriod::factory()->create()->id,
            'currency' => $this->faker->currencyCode,
            'comment' => $this->faker->text,
        ];

        $response = $this->authApi('POST', "api/employees/{$employee->id}/compensations", $data);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'data' => [
                    'employee_id',
                    'pay',
                    'rate',
                    'pay_type_id',
                    'pay_period_id',
                    'currency',
                    'comment',
                ],
            ]);
    }

    /** @test */
    public function can_update_an_existing_employee_compensation()
    {
        $compensation = Compensation::factory()->create([
            'employee_id' => Employee::factory()->create()->id,
        ]);

        $data = [
            'employee_id' => $compensation->employee_id,
            'pay' => rand(1000, 99999),
            'rate' => rand(10, 99),
            'comment' => 'comment',
        ];

        $response = $this->authApi('PATCH', "api/employees/{$compensation->employee_id}/compensations/{$compensation->id}", $data);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'employee_id',
                    'pay',
                    'rate',
                    'comment',
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $compensation->id);
        $this->assertEquals($response->getData()->data->pay, $data['pay']);
    }

    /** @test */
    public function can_retrieve_an_employee_compensation()
    {
        $compensation = Compensation::factory()->create([
            'employee_id' => Employee::factory()->create()->id,
        ]);

        $response = $this->authApi('GET', "api/employees/{$compensation->employee_id}/compensations/{$compensation->id}");

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'user_id',
                    'employee_id',
                    'effective_at',
                    'pay',
                    'rate',
                    'pay_type_id',
                    'pay_period_id',
                    'comment',
                    'currency',
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $compensation->id);
    }

    /** @test */
    public function can_retrieve_all_employee_compensations()
    {
        $compensation = Compensation::factory()->create([
            'employee_id' => Employee::factory()->create()->id,
        ]);

        $response = $this->authApi('GET', "api/employees/{$compensation->employee_id}/compensations");

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'user_id',
                        'employee_id',
                        'effective_at',
                        'pay',
                        'rate',
                        'pay_type_id',
                        'pay_period_id',
                        'comment',
                        'currency',
                    ],
                ],
            ]);
    }

    /** @test */
    public function can_delete_an_employee_compensation()
    {
        $compensationToDelete = Compensation::factory()->create([
            'employee_id' => Employee::factory()->create()->id,
        ]);

        $response = $this->authApi('DELETE', "api/employees/{$compensationToDelete->employee_id}/compensations/" . $compensationToDelete->id);

        $response->assertStatus(Response::HTTP_OK);
    }
}
