<?php

namespace HRis\PIM\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmergencyContact extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'employee_id', 'full_name', 'relationship_id', 'home_phone', 'mobile_phone', 'email', 'address', 'is_primary', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * Employee that this model belongs to.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Relationship that this model belongs to.
     */
    public function relationship(): BelongsTo
    {
        return $this->belongsTo(Relationship::class);
    }
}
