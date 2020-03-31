<?php

namespace HRis\PIM\Eloquent;

use HRis\Auth\Eloquent\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeEmploymentStatus extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'employee_id', 'employment_status_id', 'effective_at', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * User this model belongs to.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Employee this model belongs to.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * EmployeeStatus this model belongs to.
     */
    public function employmentStatus()
    {
        return $this->belongsTo(EmploymentStatus::class);
    }
}
