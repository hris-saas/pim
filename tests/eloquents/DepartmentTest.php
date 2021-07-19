<?php

namespace HRis\PIM\Tests\Eloquents;

use HRis\PIM\Tests\Test;
use HRis\PIM\Eloquent\Department;
use Symfony\Component\HttpFoundation\Response;

class DepartmentTest extends Test
{
    /** @test */
    public function can_add_a_department()
    {
        $response = $this->authApi('POST', 'api/departments', self::NAME);

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
        $data = [
            'name' => ['nl' => self::NAME],
        ];

        Department::create($data);

        $response = $this->authApi('POST', 'api/departments', self::NAME);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function can_update_an_existing_department()
    {
        $department = Department::factory()->create();

        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->authApi('PATCH', 'api/departments/' . $department->id, $data);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'sort_order',
                    'name',
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $department->id);
    }

    /** @test */
    public function can_retrieve_a_department()
    {
        $departmentToRetrieve = Department::factory()->create();

        $response = $this->authApi('GET', 'api/departments/' . $departmentToRetrieve->id);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'sort_order',
                    'name',
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $departmentToRetrieve->id);
    }

    /** @test */
    public function can_retrieve_all_departments()
    {
        Department::factory(5)->create();

        $response = $this->authApi('GET', 'api/departments?per_page=all');

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
    public function can_retrieve_all_departments_for_select()
    {
        Department::factory(5)->create();

        $response = $this->authApi('GET', 'api/departments?isSelect');

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
    public function can_retrieve_paginated_departments()
    {
        Department::factory(5)->create();

        $response = $this->authApi('GET', 'api/departments');

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
    public function can_delete_a_department()
    {
        $departmentToDelete = Department::factory()->create();

        $response = $this->authApi('DELETE', 'api/departments/' . $departmentToDelete->id);

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function can_restore_a_department()
    {
        $departmentToDelete = Department::factory()->create();
        $departmentToDelete->delete();

        $response = $this->authApi('PATCH', 'api/departments/' . $departmentToDelete->id . '/restore');

        $response->assertStatus(Response::HTTP_OK);
    }
}
