<?php

namespace HRServices\PIM\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeField extends JsonResource
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
            'id'         => $this->id,
            'sort_order' => $this->sort_order,
            'name'       => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
