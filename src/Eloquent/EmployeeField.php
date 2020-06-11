<?php

namespace HRis\PIM\Eloquent;

use HRis\Core\Traits\HasClass;
use HRis\Core\Traits\HasSortOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeField extends Model
{
    use HasClass, HasSortOrder, SoftDeletes;

    public static array $fields = [
        'departments'         => Department::class,
        'divisions'           => Division::class,
        'employment-statuses' => EmploymentStatus::class,
        'job-titles'          => JobTitle::class,
        'locations'           => Location::class,
        'marital-statuses'    => MaritalStatus::class,
        'pay-periods'         => PayPeriod::class,
        'pay-types'           => PayType::class,
        'relationships'       => Relationship::class,
        'termination-reasons' => TerminationReason::class,
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
