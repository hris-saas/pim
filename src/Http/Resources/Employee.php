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
        return array_filter([
            'id'                     => $this->id,
            'uuid'                   => $this->uuid,
            'first_name'             => $this->first_name,
            'middle_name'            => $this->middle_name,
            'last_name'              => $this->last_name,
            'salutation'             => $this->salutation,
            'nickname'               => $this->nickname,
            'employee_no'            => $this->employee_no,
            'date_of_birth'          => $this->date_of_birth,
            'identity_no'            => $this->identity_no,
            'gender'                 => $this->gender,
            'addresses'              => $this->when($this->addresses->count(), Address::collection($this->addresses)),
            'department'             => $this->when($this->department, $this->department),
            'job'                    => $this->when($this->job, new Job($this->job)),
            'location'               => $this->when($this->location, $this->location),
            'marital_status'         => $this->when($this->maritalStatus, $this->maritalStatus),
            'termination_reason'     => $this->when($this->terminationReason, $this->terminationReason),
            'work_email'             => $this->work_email,
            'personal_email'         => $this->personal_email,
            'work_phone'             => $this->work_phone,
            'work_phone_ext'         => $this->work_phone_ext,
            'mobile_phone'           => $this->mobile_phone,
            'home_phone'             => $this->home_phone,
            'is_active'              => $this->is_active,
            'reports_to'             => $this->reportsTo,
            'direct_reports'         => $this->when(! $request->query->get('groupBy'), $this->directReports()->get()),
            'indirect_reports'       => $this->indirectReports()->get(),
            'started_at'             => Carbon::parse($this->started_at)->format('F d, Y'),
            'started_at_for_display' => $this->started_at_for_display,
            'created_at'             => Carbon::parse($this->created_at)->format('F d, Y'),
            'updated_at'             => Carbon::parse($this->updated_at)->format('F d, Y'),
        ]);
    }
}
