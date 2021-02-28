<?php

namespace HRis\PIM\Tests;

use HRis\Auth\Eloquent\User;
use HRis\Core\Tests\Test as TestsCase;

class Test extends TestsCase
{
    /**
     * Service providers to load during this test.
     *
     * @var array
     */
    protected $loadProviders = [
        \HRis\Core\Providers\CoreServiceProvider::class,
        \HRis\Core\Providers\RouteServiceProvider::class,
        \HRis\Core\Providers\EventServiceProvider::class,
        \HRis\Auth\Providers\RouteServiceProvider::class,
        \HRis\Auth\Providers\AuthServiceProvider::class,
        \HRis\PIM\Providers\PIMServiceProvider::class,
        \HRis\PIM\Providers\RouteServiceProvider::class,
        \HRis\PIM\Providers\EventServiceProvider::class,
        \Laravel\Passport\PassportServiceProvider::class,
    ];

    public $appPaths = [__DIR__.'/..', __DIR__.'/../vendor/laravel/laravel'];

    public $config = ['auth.providers.users.model' => User::class, 'auth.guards.api.driver' => 'passport'];

    public $mockConsoleOutput = false;
}
