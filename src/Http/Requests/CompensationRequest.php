<?php

namespace HRis\PIM\Http\Requests;

use HRis\PIM\Eloquent\PayType;
use HRis\PIM\Eloquent\PayPeriod;
use HRis\Auth\Http\Requests\BaseRequest;

class CompensationRequest extends BaseRequest
{
    protected $rules = [
        'GET' => [],
        'POST' => [
            'pay_type_id'   => ['exists_field:'.PayType::class.',id'],
            'pay_period_id' => ['exists_field:'.PayPeriod::class.',id'],
        ],
        'PATCH' => [
            'employee_id'   => ['required', 'exists:employees,id'],
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
