<?php

namespace HRis\PIM\Tests\UnitTests;

use HRis\PIM\Tests\Test;
use Illuminate\Support\Arr;
use HRis\Auth\Eloquent\User;
use Illuminate\Support\Facades\Artisan;

class InstallationTest extends Test
{
    /** @test */
    public function service_providers_registered()
    {
        foreach ($this->loadProviders as $provider) {
            $this->assertTrue(
                Arr::get($this->app->getLoadedProviders(), $provider, false),
                "$provider is not registered"
            );
        }
        
        Artisan::call('migrate:fresh', ['--path'=> '/../../hris-saas/core/assets/migrations/tenant']);
        Artisan::call('migrate', ['--path'=> '/../../hris-saas/auth/assets/migrations/tenant']);
        Artisan::call('migrate', ['--path'=> '/../../../assets/migrations/tenant']);
        Artisan::call('passport:install', ['--force' => true]);

        User::create([
            'email' => 'tenant1@hris-saas.com',
            'name'  => 'Tenant1 Admin',
            'password' => bcrypt('password'),
        ]);
    }
}
