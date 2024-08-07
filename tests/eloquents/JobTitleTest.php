<?php

namespace HRis\PIM\Tests\Eloquents;

use HRis\PIM\Tests\Test;
use HRis\PIM\Eloquent\JobTitle;
use Symfony\Component\HttpFoundation\Response;

class JobTitleTest extends Test
{
    /** @test */
    public function can_add_a_job_title()
    {
        $response = $this->authApi('POST', 'api/job-titles', self::NAME);

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
    public function cannot_add_or_update_a_job_title_with_same_name()
    {
        $data = [
            'name' => ['nl' => self::NAME],
        ];

        JobTitle::create($data);

        $response = $this->authApi('POST', 'api/job-titles', self::NAME);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function can_update_an_existing_job_title()
    {
        $jobTitle = JobTitle::factory()->create();

        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->authApi('PATCH', 'api/job-titles/' . $jobTitle->id, $data);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'sort_order',
                    'name',
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $jobTitle->id);
    }

    /** @test */
    public function can_retrieve_a_job_title()
    {
        $jobTitleToRetrieve = JobTitle::factory()->create();

        $response = $this->authApi('GET', 'api/job-titles/' . $jobTitleToRetrieve->id);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'sort_order',
                    'name',
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $jobTitleToRetrieve->id);
    }

    /** @test */
    public function can_retrieve_all_job_titles()
    {
        JobTitle::factory(5)->create();

        $response = $this->authApi('GET', 'api/job-titles?per_page=all');

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
    public function can_retrieve_all_job_titles_for_select()
    {
        JobTitle::factory(5)->create();

        $response = $this->authApi('GET', 'api/job-titles?isSelect');

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
    public function can_retrieve_paginated_job_titles()
    {
        JobTitle::factory(5)->create();

        $response = $this->authApi('GET', 'api/job-titles');

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
    public function can_delete_a_job_title()
    {
        $jobTitleToDelete = JobTitle::factory()->create();

        $response = $this->authApi('DELETE', 'api/job-titles/' . $jobTitleToDelete->id);

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function can_restore_a_job_title()
    {
        $jobTitleToDelete = JobTitle::factory()->create();
        $jobTitleToDelete->delete();

        $response = $this->authApi('PATCH', 'api/job-titles/' . $jobTitleToDelete->id . '/restore');

        $response->assertStatus(Response::HTTP_OK);
    }
}
