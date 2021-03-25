<?php

namespace HRis\PIM\Eloquent;

use HRis\Baum;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use HRis\Auth\Eloquent\User;
use HRis\PIM\Traits\UsesBaum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Database\Factories\EmployeeFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property HasMany addresses
 * @property HasMany compensation
 * @property HasMany emergencyContacts
 */
class Employee extends Baum\Node
{
    use HasFactory, SoftDeletes, UsesBaum;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['uuid', 'user_id', 'department_id', 'location_id', 'marital_status_id', 'termination_reason_id', 'first_name', 'middle_name', 'last_name', 'salutation', 'nickname', 'employee_no', 'date_of_birth', 'identity_no', 'gender', 'work_phone', 'work_phone_ext', 'mobile_phone', 'home_phone', 'work_email', 'personal_email', 'avatar', 'is_active', 'reports_to_id', 'started_at', 'termination_performed_at', 'terminated_at', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * Create a new factory instance for the model.
     *
     * @return Factory
     */
    protected static function newFactory(): Factory
    {
        return EmployeeFactory::new();
    }

    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     * User that this model belongs to.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Department that this model belongs to.
     *
     * @return BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Location that this model belongs to.
     *
     * @return BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * MaritalStatus that this model belongs to.
     *
     * @return BelongsTo
     */
    public function maritalStatus(): BelongsTo
    {
        return $this->belongsTo(MaritalStatus::class);
    }

    /**
     * MaritalStatus that this model belongs to.
     *
     * @return BelongsTo
     */
    public function terminationReason(): BelongsTo
    {
        return $this->belongsTo(TerminationReason::class);
    }

    /**
     * Addresses that this model has.
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    /**
     * EmploymentStatuses that this model has.
     */
    public function employmentStatuses(): HasMany
    {
        return $this->hasMany(EmployeeEmploymentStatus::class);
    }

    /**
     * Jobs that this model has.
     */
    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }

    /**
     * EmergencyContacts that this model has.
     */
    public function emergencyContacts(): HasMany
    {
        return $this->hasMany(EmergencyContact::class);
    }

    /**
     * Compensations that this model has.
     */
    public function compensation(): HasMany
    {
        return $this->hasMany(Compensation::class);
    }

    /**
     * Wrap $this->children() to directReports
     *
     * @return mixed|array
     */
    public function directReports()
    {
        return $this->children();
    }

    /**
     * Wrap $this->descendants() to directReports
     *
     * @return mixed|array
     */
    public function indirectReports()
    {
        return $this->descendants();
    }

    public static function transactionSafeCreate(array $data): self
    {
        self::sanitize($data);

        $employee = null;

        DB::transaction(function () use ($data, &$employee) {
            $employee = self::create($data);

            // Addresses
            collect($data['addresses'])->each(function ($address) use ($employee) {
                $employee->addresses()->save(Address::create($address));
            });

            // Job
            $job = Arr::only($data, ['user_id', 'location_id', 'division_id', 'department_id', 'job_title_id', 'reports_to_id', 'effective_at']);
            $employee->jobs()->save(Job::create($job));

            // Employment Status
            $employmentStatus = Arr::only($data, ['user_id', 'employment_status_id', 'effective_at']);
            $employee->employmentStatuses()->save(EmployeeEmploymentStatus::create($employmentStatus));

            // Compensation
            $compensation = Arr::only($data, ['user_id', 'effective_at', 'pay', 'rate', 'pay_type_id', 'pay_period_id', 'currency']);
            $employee->compensation()->save(Compensation::create($compensation));

            // User, only if ESS is on
            if ($data['is_ess_on']) {
                $user = Arr::only($data, ['name', 'email', 'password']);
                $employee->user()->associate(User::create($user))->save();

                // TODO: send welcome email to user
            }
        });

        return $employee;
    }

    protected static function sanitize(array &$data)
    {
        $data['uuid'] = Uuid::uuid4();
        $data['date_of_birth'] = sprintf(
            '%d-%d-%d',
            $data['date_of_birth']['year'],
            $data['date_of_birth']['month'],
            $data['date_of_birth']['day']
        );

        $data['started_at'] = $data['effective_at'] = sprintf(
            '%d-%d-%d',
            $data['date_of_start']['year'],
            $data['date_of_start']['month'],
            $data['date_of_start']['day']
        );

        $data['pay']  = $data['pay_value'];
        $data['rate'] = $data['pay_rate'];

        $data['name'] = "{$data['first_name']} {$data['last_name']}";
        $data['email'] = $data['work_email'];
        $data['password'] = Str::random();

        unset($data['date_of_start'], $data['pay_value'], $data['pay_rate']);

        Log::info($data);
    }
}
