<?php

namespace HRis\PIM\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeEmploymentStatus extends JsonResource
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
            'id'                => $this->id,
            'user_id'           => $this->user_id,
            'employment_status' => $this->when($this->employmentStatus, optional($this->employmentStatus)->name),
            'effective_at'      => $this->effective_at,
            'comment'           => $this->comment,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
            'deleted_at'        => $this->deleted_at,
        ];
    }
}
