<?php

namespace HRis\PIM\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmergencyContact extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'employee_id', 'full_name', 'relationship_id', 'home_phone', 'mobile_phone', 'email', 'address', 'is_primary', 'created_at', 'updated_at', 'deleted_at'];

    protected static function newFactory()
    {
        return \Database\Factories\EmergencyContactFactory::new();
    }

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
