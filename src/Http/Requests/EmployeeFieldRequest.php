<?php

namespace HRis\PIM\Http\Requests;

use HRis\PIM\Eloquent\EmployeeField;
use HRis\Auth\Http\Requests\BaseRequest;

class EmployeeFieldRequest extends BaseRequest
{
    protected $rules = [
        'GET' => [],
        'POST' => [
            'name' => ['required', 'max:255', 'unique_field:'.EmployeeField::class.',name'],
        ],
        'PATCH' => [
            'name' => ['filled', 'max:255'],
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
        $this->addQuery();

        return $this->rules[$this->method()];
    }

    /**
     * Get all request attribute except those two special ones.
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->except('model_type', 'model_id');
    }

    /**
     * Add special model_type and model_id attributes to the request array.
     *
     * @return void
     */
    protected function addQuery(): void
    {
        $fields = config('hris-saas.models.employee-fields');

        $this->query->add(['model_type' => $fields[$this->segment(2)]]);

        $this->rules['PATCH']['sort_order'][] = 'sort_order_field:'.EmployeeField::class;

        if (count($this->segments()) >= 3) {
            $this->query->add(['model_id' => (int) $this->segment(3)]);
            $this->rules['PATCH']['name'][] = 'unique_field:'.EmployeeField::class.',name,'. $this->segment(3);
        }
    }
}
