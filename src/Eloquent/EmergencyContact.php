<?php

namespace HRis\PIM\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Database\Factories\EmergencyContactFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmergencyContact extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'employee_id', 'full_name', 'relationship_id', 'home_phone', 'mobile_phone', 'email', 'address', 'is_primary', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * Create a new factory instance for the model.
     *
     * @return Factory
     */
    protected static function newFactory(): Factory
    {
        return EmergencyContactFactory::new();
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
