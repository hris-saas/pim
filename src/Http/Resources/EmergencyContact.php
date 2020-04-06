<?php

namespace HRis\PIM\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmergencyContact extends JsonResource
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
            'id'           => $this->id,
            'user_id'      => $this->user_id,
            'employee_id'  => $this->employee_id,
            'full_name'    => $this->full_name,
            'relationship' => $this->when($this->relationship, optional($this->relationship)->name),
            'home_phone'   => $this->home_phone,
            'mobile_phone' => $this->mobile_phone,
            'email'        => $this->email,
            'address'      => $this->address,
            'is_primary'   => $this->is_primary,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
            'deleted_at'   => $this->deleted_at,
        ];
    }
}
