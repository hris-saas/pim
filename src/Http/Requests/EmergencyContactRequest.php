<?php

namespace HRis\PIM\Http\Requests;

use HRis\PIM\Eloquent\Relationship;
use HRis\Auth\Http\Requests\BaseRequest;

class EmergencyContactRequest extends BaseRequest
{
    protected $rules = [
        'GET' => [],
        'POST' => [
            'full_name'       => ['required'],
            'relationship_id' => ['required', 'exists_field:'.Relationship::class.',id'],
            'mobile_phone'    => ['required'],
        ],
        'PATCH' => [
            'full_name'       => ['filled'],
            'relationship_id' => ['filled', 'exists_field:'.Relationship::class.',id'],
            'mobile_phone'    => ['filled'],
        ],
        'DELETE' => [],
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return $this->rules[$this->method()];
    }
}
