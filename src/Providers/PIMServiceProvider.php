<?php

namespace HRis\PIM\Providers;

use HRis\PIM\Validators\Validator;
use HRis\Core\Providers\BaseServiceProvider;

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

        $this->registerTranslations();

        $this->registerConfigs();

        Validator::registerValidators();
    }

    /**
     * Register Auth's translation files.
     *
     * @return void
     */
    protected function registerTranslations(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../../assets/lang', 'pim');

        $this->publishes([
            __DIR__.'/../../assets/lang' => resource_path('lang/vendor/hris-saas/pim'),
        ], 'hris-saas::pim-translations');
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
     * Register PIM's config files.
     *
     * @return void
     */
    protected function registerConfigs(): void
    {
        $path = realpath(__DIR__.'/../../assets/config/config.php');

        $this->mergeConfigFrom($path, 'hris-saas');
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
