<?php

namespace HRis\PIM\Eloquent;

use HRis\Baum;
use HRis\PIM\Traits\UsesBaum;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property HasMany addresses
 * @property HasMany compensation
 * @property HasMany emergencyContacts
 */
class Employee extends Baum\Node
{
    use SoftDeletes, UsesBaum;

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
        return $this->belongsTo(Department::class);
    }

    /**
     * Location that this model belongs to.
     *
     * @return BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * MaritalStatus that this model belongs to.
     *
     * @return BelongsTo
     */
    public function maritalStatus(): BelongsTo
    {
        return $this->belongsTo(MaritalStatus::class);
    }

    /**
     * MaritalStatus that this model belongs to.
     *
     * @return BelongsTo
     */
    public function terminationReason(): BelongsTo
    {
        return $this->belongsTo(TerminationReason::class);
    }

    /**
     * Addresses that this model has.
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    /**
     * EmploymentStatuses that this model has.
     */
    public function employmentStatuses(): HasMany
    {
        return $this->hasMany(EmployeeEmploymentStatus::class);
    }

    /**
     * Jobs that this model has.
     */
    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }

    /**
     * EmergencyContacts that this model has.
     */
    public function emergencyContacts(): HasMany
    {
        return $this->hasMany(EmergencyContact::class);
    }

    /**
     * Compensations that this model has.
     */
    public function compensation(): HasMany
    {
        return $this->hasMany(Compensation::class);
    }
}
