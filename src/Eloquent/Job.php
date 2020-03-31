<?php

namespace HRis\PIM\Eloquent;

use HRis\Auth\Eloquent\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'employee_id', 'location_id', 'division_id', 'department_id', 'job_title_id', 'reports_to_id', 'effective_at', 'comment', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * User that this model belongs to.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Employee that this model belongs to.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Location that this model belongs to.
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * division that this model belongs to.
     */
    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    /**
     * Department that this model belongs to.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * JobTitle that this model belongs to.
     */
    public function jobTitle()
    {
        return $this->belongsTo(JobTitle::class);
    }

    /**
     * ReportsTo that this model belongs to.
     */
    public function reportsTo()
    {
        return $this->belongsTo(Employee::class, 'reports_to_id');
    }
}
