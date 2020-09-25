<?php

namespace HRis\PIM\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'employee_id', 'address_1', 'address_2', 'city', 'state', 'postal_code', 'country', 'created_at', 'updated_at', 'deleted_at'];

    protected static function newFactory()
    {
        return \Database\Factories\AddressFactory::new();
    }

    /**
     * Employee that this model belongs to.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
