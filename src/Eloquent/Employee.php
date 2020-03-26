<?php

namespace HRis\PIM\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'department_id', 'location_id', 'marital_status_id', 'termination_reason_id', 'first_name', 'middle_name', 'last_name', 'salutation', 'nickname', 'employee_no', 'date_of_birth', 'identity_no', 'gender', 'work_phone', 'work_phone_ext', 'mobile_phone', 'home_phone', 'work_email', 'personal_email', 'avatar', 'started_at', 'termination_performed_at', 'terminated_at', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * Department that this model belongs to.
     *
     * @return BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    /**
     * Location that this model belongs to.
     *
     * @return BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    /**
     * MaritalStatus that this model belongs to.
     *
     * @return BelongsTo
     */
    public function maritalStatus(): BelongsTo
    {
        return $this->belongsTo(MaritalStatus::class, 'marital_status_id');
    }

    /**
     * MaritalStatus that this model belongs to.
     *
     * @return BelongsTo
     */
    public function terminationReason(): BelongsTo
    {
        return $this->belongsTo(TerminationReason::class, 'termination_reason_id');
    }
}
