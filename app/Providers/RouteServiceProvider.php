<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * @var string|null
     */
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {

            $version = config('base.conf.version');
            $service = config('base.conf.service');

            Route::match(['get', 'post'], 'testing', "$this->namespace\\Controller@testing");

            Route::prefix(config('base.conf.prefix.web') . "/$version/$service")
                ->middleware(['web'])
                ->namespace("$this->namespace\\" . config('base.conf.namespace.web') . "\\$version")
                ->group(base_path('routes/web.php'));

            Route::prefix(config('base.conf.prefix.mobile') . "/$version/$service")
                ->middleware(['web'])
                ->namespace("$this->namespace\\" . config('base.conf.namespace.mobile') . "\\$version")
                ->group(base_path('routes/mobile.php'));

            Route::prefix(config('base.conf.prefix.b2b') . "/$version/$service")
                ->middleware(['web'])
                ->namespace("$this->namespace\\" . config('base.conf.namespace.b2b') . "\\$version")
                ->group(base_path('routes/b2b.php'));

            Route::prefix(config('base.conf.prefix.mygx') . "/$version/$service")
                ->middleware(['web'])
                ->namespace("$this->namespace\\" . config('base.conf.namespace.mygx') . "\\$version")
                ->group(base_path('routes/mygx.php'));

        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
