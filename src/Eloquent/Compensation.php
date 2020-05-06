<?php

namespace HRis\PIM\Eloquent;

use Hris\Auth\Eloquent\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compensation extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'employee_id',
        'effective_at',
        'pay',
        'rate',
        'pay_type_id',
        'pay_period_id',
        'change_reason_id',
        'comment',
        'currency',
    ];

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
     * Pay period this model belongs to.
     */
    public function payPeriod()
    {
        return $this->belongsTo(PayPeriod::class);
    }

    /**
     * Pay type this model belongs to.
     */
    public function payType()
    {
        return $this->belongsTo(PayType::class);
    }
}
