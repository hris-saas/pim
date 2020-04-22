<?php

namespace HRis\PIM\Providers;

use HRis\PIM\Validators\Validator;
use Illuminate\Database\Eloquent\Factory;
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

        $this->registerFactories();

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
     * Register PIM's factory files.
     *
     * @return void
     */
    protected function registerFactories(): void
    {
        $this->app->make(Factory::class)->load(__DIR__ . '/../../assets/database/factories');
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
