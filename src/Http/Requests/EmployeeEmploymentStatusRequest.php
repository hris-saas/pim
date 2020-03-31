<?php

namespace HRis\PIM\Http\Requests;

use HRis\PIM\Eloquent\EmploymentStatus;
use HRis\Auth\Http\Requests\BaseRequest;

class EmployeeEmploymentStatusRequest extends BaseRequest
{
    protected $rules = [
        'GET' => [],
        'POST' => [
            'employment_status_id' => ['required', 'exists_field:'.EmploymentStatus::class.',id'],
        ],
        'PATCH' => [
            'employment_status_id' => ['required', 'exists_field:'.EmploymentStatus::class.',id'],
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
