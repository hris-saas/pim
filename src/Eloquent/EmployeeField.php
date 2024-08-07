<?php

namespace HRis\PIM\Eloquent;

use HRis\Core\Traits\HasClass;
use HRis\Core\Traits\HasSortOrder;
use HRis\Core\Traits\HasMovingForward;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeField extends Model
{
    use HasClass, HasMovingForward, HasSortOrder, HasTranslations, SoftDeletes;

    public static array $fields = [
        'change-reasons'      => ChangeReason::class,
        'departments'         => Department::class,
        'divisions'           => Division::class,
        'job-titles'          => JobTitle::class,
        'locations'           => Location::class,
        'pay-periods'         => PayPeriod::class,
        'pay-types'           => PayType::class,
        'relationships'       => Relationship::class,
        'termination-reasons' => TerminationReason::class,
    ];

    public $translatable = ['name'];

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
