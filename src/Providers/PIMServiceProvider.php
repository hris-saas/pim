<?php

namespace HRServices\PIM\Providers;

use HRServices\PIM\Eloquent\PayType;
use HRServices\PIM\Eloquent\Division;
use HRServices\PIM\Eloquent\JobTitle;
use HRServices\PIM\Eloquent\Location;
use HRServices\PIM\Eloquent\PayPeriod;
use HRServices\PIM\Eloquent\Department;
use HRServices\PIM\Validators\Validator;
use HRServices\PIM\Eloquent\MaritalStatus;
use HRServices\PIM\Observers\PayTypeObserver;
use HRServices\PIM\Eloquent\TerminationReason;
use HRServices\PIM\Observers\DivisionObserver;
use HRServices\PIM\Observers\JobTitleObserver;
use HRServices\PIM\Observers\LocationObserver;
use HRServices\PIM\Observers\PayPeriodObserver;
use HRServices\PIM\Observers\DepartmentObserver;
use HRServices\PIM\Observers\MaritalStatusObserver;
use HRServices\PIM\Observers\TerminationReasonObserver;
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
            ], 'hr-services::pim-migrations');
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
