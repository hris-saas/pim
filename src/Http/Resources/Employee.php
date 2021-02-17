<?php

namespace HRis\PIM\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class Employee extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'                 => $this->id,
            'uuid'               => $this->uuid,
            'first_name'         => $this->first_name,
            'middle_name'        => $this->middle_name,
            'last_name'          => $this->last_name,
            'salutation'         => $this->salutation,
            'nickname'           => $this->nickname,
            'employee_no'        => $this->employee_no,
            'date_of_birth'      => $this->date_of_birth,
            'identity_no'        => $this->identity_no,
            'gender'             => $this->gender,
            'addresses'          => Address::collection($this->addresses),
            'department'         => $this->when($this->department, optional($this->department)->name),
            'location'           => $this->when($this->location, optional($this->location)->name),
            'marital_status'     => $this->when($this->maritalStatus, optional($this->maritalStatus)->name),
            'termination_reason' => $this->when($this->terminationReason, optional($this->terminationReason)->name),
            'work_email'         => $this->work_email,
            'personal_email'     => $this->personal_email,
            'work_phone'         => $this->work_phone,
            'work_phone_ext'     => $this->work_phone_ext,
            'mobile_phone'       => $this->mobile_phone,
            'home_phone'         => $this->home_phone,
            'is_active'          => $this->is_active,
            'started_at'         => Carbon::parse($this->started_at)->format('F d, Y'),
            'created_at'         => $this->created_at,
            'updated_at'         => $this->updated_at,
            'deleted_at'         => $this->deleted_at,
        ];
    }
}
