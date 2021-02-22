<?php

namespace HRis\PIM\Providers;

use HRis\PIM\Eloquent\EmployeeField;
use HRis\PIM\Observers\EmployeeFieldObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        $employeeFields = EmployeeField::$fields;

        foreach ($employeeFields as $model) {
            (new $model)::observe(EmployeeFieldObserver::class);
        }
    }
}
