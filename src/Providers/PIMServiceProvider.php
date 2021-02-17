<?php

namespace HRis\PIM\Providers;

use HRis\PIM\Validators\Validator;
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
                __DIR__.'/../../assets/database/migrations' => database_path('migrations'),
            ], 'hris-saas::pim-migrations');
        }

        Validator::registerValidators();
    }

    /**
     * Register PIM's migration files.
     *
     * @return void
     */
    protected function registerMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../../assets/database/migrations');
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
