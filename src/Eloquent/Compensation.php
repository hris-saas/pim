<?php

namespace HRis\PIM\Eloquent;

use Hris\Auth\Eloquent\User;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\CompensationFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Compensation extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'employee_id', 'effective_at', 'pay', 'rate', 'pay_type_id', 'pay_period_id', 'change_reason_id', 'comment', 'currency',];

    /**
     * Create a new factory instance for the model.
     *
     * @return Factory
     */
    protected static function newFactory(): Factory
    {
        return CompensationFactory::new();
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
     * Pay period this model belongs to.
     */
    public function payPeriod(): BelongsTo
    {
        return $this->belongsTo(PayPeriod::class);
    }

    /**
     * Pay type this model belongs to.
     */
    public function payType(): BelongsTo
    {
        return $this->belongsTo(PayType::class);
    }
}
