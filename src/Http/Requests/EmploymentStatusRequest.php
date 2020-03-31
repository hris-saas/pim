<?php

namespace HRis\PIM\Http\Requests;

use HRis\Auth\Http\Requests\BaseRequest;

class EmploymentStatusRequest extends BaseRequest
{
    protected $rules = [
        'GET' => [],
        'POST' => [],
        'PATCH' => [],
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
