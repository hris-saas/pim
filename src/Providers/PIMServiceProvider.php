<?php

namespace HRis\PIM\Providers;

use HRis\PIM\Eloquent\PayType;
use HRis\PIM\Eloquent\Division;
use HRis\PIM\Eloquent\JobTitle;
use HRis\PIM\Eloquent\Location;
use HRis\PIM\Eloquent\PayPeriod;
use HRis\PIM\Eloquent\Department;
use HRis\PIM\Validators\Validator;
use HRis\PIM\Eloquent\MaritalStatus;
use HRis\PIM\Eloquent\EmploymentStatus;
use HRis\PIM\Observers\PayTypeObserver;
use HRis\PIM\Eloquent\TerminationReason;
use HRis\PIM\Observers\DivisionObserver;
use HRis\PIM\Observers\JobTitleObserver;
use HRis\PIM\Observers\LocationObserver;
use HRis\PIM\Observers\PayPeriodObserver;
use HRis\PIM\Observers\DepartmentObserver;
use HRis\PIM\Observers\MaritalStatusObserver;
use HRis\PIM\Observers\EmploymentStatusObserver;
use HRis\PIM\Observers\TerminationReasonObserver;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class PIMServiceProvider extends BaseServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->registerMigrations();

            $this->publishes([
                __DIR__.'/../../assets/migrations' => database_path('migrations'),
            ], 'hris-saas::pim-migrations');
        }

        $this->registerEloquentObservers();

        Validator::registerValidators();
    }

    /**
     * Register PIM's migration files.
     *
     * @return void
     */
    protected function registerMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../../assets/migrations');
    }

    /**
     * Register PIM's eloquent observers.
     *
     * @return void
     */
    protected function registerEloquentObservers(): void
    {
        Department::observe(DepartmentObserver::class);
        Location::observe(LocationObserver::class);
        JobTitle::observe(JobTitleObserver::class);
        MaritalStatus::observe(MaritalStatusObserver::class);
        TerminationReason::observe(TerminationReasonObserver::class);
        Division::observe(DivisionObserver::class);
        PayPeriod::observe(PayPeriodObserver::class);
        PayType::observe(PayTypeObserver::class);
        EmploymentStatus::observe(EmploymentStatusObserver::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        // TODO: Implement register() method.
    }
}
