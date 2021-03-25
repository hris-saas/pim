<?php

namespace HRis\PIM\Http\Requests;

use HRis\PIM\Eloquent\PayType;
use HRis\PIM\Eloquent\JobTitle;
use HRis\PIM\Eloquent\Location;
use HRis\PIM\Eloquent\PayPeriod;
use HRis\PIM\Eloquent\Department;
use HRis\PIM\Eloquent\ChangeReason;
use HRis\PIM\Eloquent\MaritalStatus;
use HRis\PIM\Eloquent\EmploymentStatus;
use HRis\Auth\Http\Requests\BaseRequest;
use HRis\PIM\Eloquent\TerminationReason;

class EmployeeRequest extends BaseRequest
{
    protected $rules = [
        'GET' => [],
        'POST' => [
            'first_name'            => ['required'],
            'last_name'             => ['required'],
            'gender'                => ['required'],
            'department_id'         => ['exists_field:'.Department::class.',id'],
            'location_id'           => ['required', 'exists_field:'.Location::class.',id'],
            'job_title_id'          => ['required', 'exists_field:'.JobTitle::class.',id'],
            'is_active'             => ['required'],
            'marital_status_id'     => ['required', 'exists_field:'.MaritalStatus::class.',id'],
            'employment_status_id'  => ['required', 'exists_field:'.EmploymentStatus::class.',id'],
            'termination_reason'    => ['exists_field:'.TerminationReason::class.',id'],
            'employee_no'           => ['required','unique:employees,employee_no'],
            'date_of_birth'         => ['array'],
            'date_of_birth.day'     => ['required', 'min:1', 'max:31'],
            'date_of_birth.month'   => ['required', 'min:1', 'max:12'],
            'date_of_birth.year'    => ['required'],
            'date_of_start'         => ['array'],
            'date_of_start.day'     => ['required', 'min:1', 'max:31'],
            'date_of_start.month'   => ['required', 'min:1', 'max:12'],
            'date_of_start.year'    => ['required'],
            'addresses'             => ['array'],
            'addresses.*.address_1' => ['required'],
            'addresses.*.city'      => ['required'],
            'addresses.*.country'   => ['required'],
            'mobile_phone'          => ['required'],
            'work_email'            => ['required', 'email'],
            'pay_value'             => ['required'],
            'pay_rate'              => ['required'],
            'currency'              => ['required'],
            'pay_type_id'           => ['required', 'exists_field:'.PayType::class.',id'],
            'pay_period_id'         => ['required', 'exists_field:'.PayPeriod::class.',id'],
            'change_reason_id'      => ['required', 'exists_field:'.ChangeReason::class.',id'],
            'is_ess_on'             => ['required'],
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

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [

            'employee_no'             => trans('pim::employees.employee_no'),

            'is_active'               => trans('pim::employees.is_active'),

            'marital_status_id'       => trans('pim::employees.marital_status_id'),

            'employment_status_id'    => trans('pim::employees.employment_status_id'),

            'department_id'           => trans('pim::employees.department_id'),
            'location_id'             => trans('pim::employees.location_id'),
            'job_title_id'            => trans('pim::employees.job_title_id'),

            'pay_type_id'             => trans('pim::employees.pay_type_id'),
            'pay_period_id'           => trans('pim::employees.pay_period_id'),
            'change_reason_id'        => trans('pim::employees.change_reason_id'),

            'date_of_birth.day'       => trans('pim::employees.day_of_birth'),
            'date_of_birth.month'     => trans('pim::employees.month_of_birth'),
            'date_of_birth.year'      => trans('pim::employees.year_of_birth'),

            'date_of_start.day'       => trans('pim::employees.day_of_start'),
            'date_of_start.month'     => trans('pim::employees.month_of_start'),
            'date_of_start.year'      => trans('pim::employees.year_of_start'),

            'addresses.*.address_1'   => trans('pim::employees.address_1'),
            'addresses.*.address_2'   => trans('pim::employees.address_2'),
            'addresses.*.city'        => trans('pim::employees.city'),
            'addresses.*.state'       => trans('pim::employees.state'),
            'addresses.*.postal_code' => trans('pim::employees.postal_code'),
            'addresses.*.country'     => trans('pim::employees.country'),

            'pay_value'               => trans('pim::employees.pay_value'),
            'pay_rate'                => trans('pim::employees.pay_rate'),
        ];
    }
}
