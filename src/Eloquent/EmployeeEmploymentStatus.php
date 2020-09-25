<?php

namespace HRis\PIM\Eloquent;

use HRis\Auth\Eloquent\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeEmploymentStatus extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'employee_id', 'employment_status_id', 'effective_at', 'comment', 'created_at', 'updated_at', 'deleted_at'];

    protected static function newFactory()
    {
        return \Database\Factories\EmployeeEmploymentStatusFactory::new();
    }

    /**
     * User this model belongs to.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Employee this model belongs to.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * EmployeeStatus this model belongs to.
     */
    public function employmentStatus(): BelongsTo
    {
        return $this->belongsTo(EmploymentStatus::class);
    }
}
