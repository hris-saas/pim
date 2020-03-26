<?php

namespace HRis\PIM\Http\Requests;

use HRis\PIM\Eloquent\Location;
use HRis\PIM\Eloquent\Department;
use HRis\Auth\Http\Requests\BaseRequest;
use HRis\PIM\Eloquent\TerminationReason;

class EmployeeRequest extends BaseRequest
{
    protected $rules = [
        'GET' => [],
        'POST' => [
            'department_id' => ['exists_field:'.Department::class.',id'],
            'location_id' => ['exists_field:'.Location::class.',id'],
            'marital_status_id' => ['exists_field:'.Location::class.',id'],
            'termination_reason_id' => ['exists_field:'.TerminationReason::class.',id'],
            'employee_no' => ['unique:employees,employee_no'],
        ],
        'PATCH' => [
            'department_id' => ['exists_field:'.Department::class.',id'],
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
