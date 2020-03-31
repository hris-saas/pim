<?php

namespace HRis\PIM\Eloquent;

use HRis\Core\Traits\HasClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeField extends Model
{
    use HasClass, SoftDeletes;

    public static $fields = [
        'departments'         => Department::class,
        'locations'           => Location::class,
        'job-titles'          => JobTitle::class,
        'marital-statuses'    => MaritalStatus::class,
        'termination-reasons' => TerminationReason::class,
        'divisions'           => Division::class,
        'pay-periods'         => PayPeriod::class,
        'pay-types'           => PayType::class,
        'employment-statuses' => EmploymentStatus::class,
    ];
    
    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = ['class' => self::class];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'sort_order', 'name', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employee_fields';
}
