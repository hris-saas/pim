<?php

namespace HRis\PIM\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Compensation extends JsonResource
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
            'id'            => $this->id,
            'user_id'       => $this->user_id,
            'employee_id'   => $this->employee_id,
            'effective_at'  => $this->effective_at,
            'pay'           => $this->pay,
            'rate'          => $this->rate,
            'pay_type_id'   => $this->pay_type_id,
            'pay_period_id' => $this->pay_period_id,
            'comment'       => $this->comment,
            'currency'      => $this->currency,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
            'deleted_at'    => $this->deleted_at,
        ];
    }
}
