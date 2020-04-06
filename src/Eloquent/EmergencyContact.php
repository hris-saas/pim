<?php

namespace HRis\PIM\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Relationship that this model belongs to.
     */
    public function relationship()
    {
        return $this->belongsTo(Relationship::class);
    }
}
