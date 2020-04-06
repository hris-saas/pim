<?php

namespace HRis\PIM\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $middleware = [];
    
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'HRis\PIM\Http\Controllers';

    protected $alias = 'pim::';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot(): void
    {
        parent::boot();

        foreach ($this->middleware as $name => $class) {
            $this->app['router']->aliasMiddleware($name, $class);
        }
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map(): void
    {
        $this->mapApiRoutes();
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes(): void
    {
        $routeFiles = collect(File::files(__DIR__.'/../routes/api'))->map->getFilename();

        foreach ($routeFiles as $routeFile) {
            Route::prefix('api')
                ->middleware(['bindings', 'throttle'])
                ->as($this->alias)
                ->namespace($this->namespace)
                ->group(__DIR__."/../routes/api/{$routeFile}");
        }
    }
}
