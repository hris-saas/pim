<?php

namespace HRis\PIM\Tests\Eloquents;

use HRis\PIM\Tests\Test;
use HRis\PIM\Eloquent\Employee;
use HRis\PIM\Eloquent\Relationship;
use HRis\PIM\Eloquent\EmergencyContact;
use Symfony\Component\HttpFoundation\Response;

class EmergencyContactTest extends Test
{
    /** @test */
    public function can_add_an_employee_emergency_contact()
    {
        $employee = Employee::factory()->create();

        $data = [
            'full_name' => $this->faker->name,
            'relationship_id' => Relationship::factory()->create()->id,
            'home_phone' => $this->faker->phoneNumber,
            'mobile_phone' => $this->faker->phoneNumber,
            'email' => $this->faker->safeEmail,
            'address' => $this->faker->address,
            'is_primary' => true,
        ];

        $response = $this->authApi('POST', "api/employees/{$employee->id}/emergency-contacts", $data);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'data' => [
                    'full_name',
                    'relationship',
                    'home_phone',
                    'mobile_phone',
                    'email',
                    'address',
                    'is_primary',
                ],
            ]);
    }

    /** @test */
    public function can_update_an_existing_employee_emergency_contact()
    {
        $emergencyContact = EmergencyContact::factory()->create([
            'employee_id' => Employee::factory()->create()->id,
        ]);

        $data = [
            'full_name' => $this->faker->name,
        ];

        $response = $this->authApi('PATCH', "api/employees/{$emergencyContact->employee_id}/emergency-contacts/{$emergencyContact->id}", $data);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'full_name',
                    'relationship',
                    'home_phone',
                    'mobile_phone',
                    'email',
                    'address',
                    'is_primary',
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $emergencyContact->id);
        $this->assertEquals($response->getData()->data->full_name, $data['full_name']);
    }

    /** @test */
    public function can_retrieve_an_employee_emergency_contact()
    {
        $emergencyContact = EmergencyContact::factory()->create([
            'employee_id' => Employee::factory()->create()->id,
        ]);

        $response = $this->authApi('GET', "api/employees/{$emergencyContact->employee_id}/emergency-contacts/{$emergencyContact->id}");

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'full_name',
                    'relationship',
                    'home_phone',
                    'mobile_phone',
                    'email',
                    'address',
                    'is_primary',
                ],
            ]);

        $this->assertEquals($response->getData()->data->id, $emergencyContact->id);
    }

    /** @test */
    public function can_retrieve_all_employee_emergency_contacts()
    {
        $emergencyContact = EmergencyContact::factory()->create([
            'employee_id' => Employee::factory()->create()->id,
        ]);

        $response = $this->authApi('GET', "api/employees/{$emergencyContact->employee_id}/emergency-contacts");

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    [
                        'full_name',
                        'relationship',
                        'home_phone',
                        'mobile_phone',
                        'email',
                        'address',
                        'is_primary',
                    ],
                ],
            ]);
    }

    /** @test */
    public function can_delete_an_employee_emergency_contact()
    {
        $emergencyContactToDelete = EmergencyContact::factory()->create([
            'employee_id' => Employee::factory()->create()->id,
        ]);

        $response = $this->authApi('DELETE', "api/employees/{$emergencyContactToDelete->employee_id}/emergency-contacts/" . $emergencyContactToDelete->id);

        $response->assertStatus(Response::HTTP_OK);
    }
}
