<?php

namespace HRis\PIM\Http\Resources;

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
            'first_name'         => $this->first_name,
            'middle_name'        => $this->middle_name,
            'last_name'          => $this->last_name,
            'salutation'         => $this->salutation,
            'nickname'           => $this->nickname,
            'employee_no'        => $this->employee_no,
            'date_of_birth'      => $this->date_of_birth,
            'identity_no'        => $this->identity_no,
            'gender'             => $this->gender,
            'department'         => $this->when($this->department, optional($this->department)->name),
            'location'           => $this->when($this->location, optional($this->location)->name),
            'marital_status'     => $this->when($this->maritalStatus, optional($this->maritalStatus)->name),
            'termination_reason' => $this->when($this->terminationReason, optional($this->terminationReason)->name),
            'created_at'         => $this->created_at,
            'updated_at'         => $this->updated_at,
            'deleted_at'         => $this->deleted_at,
        ];
    }
}
