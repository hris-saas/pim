<?php

namespace HRis\PIM\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Status extends JsonResource
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
            'id'           => $this->id,
            'parent_id'    => $this->when(! $request->query->get('isSelect'), $this->parent_id),
            'sort_order'   => $this->when(! $request->query->get('isSelect'), $this->sort_order),
            'name'         => $this->name,
            'is_completed' => $this->when(! $request->query->get('isSelect'), $this->is_completed),
        ]);
    }
}
