<?php

namespace HRis\PIM\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Job extends JsonResource
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
            'location'     => $this->when($this->location, optional($this->location)->name),
            'department'   => $this->when($this->department, optional($this->department)->name),
            'division'     => $this->when($this->division, optional($this->division)->name),
            'job_title'    => $this->when($this->jobTitle, optional($this->jobTitle)->name),
            'effective_at' => $this->effective_at,
            'comment'      => $this->comment,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
            'deleted_at'   => $this->deleted_at,
        ];
    }
}
