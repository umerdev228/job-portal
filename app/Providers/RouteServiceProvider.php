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
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const ADMIN_DASHBOARD = '/admin/dashboard';
    public const PROVIDER_DASHBOARD = '/provider/dashboard';
    public const SEEKER_DASHBOARD = '/seeker/dashboard';

    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));


            Route::middleware(['web', 'auth'])
                ->as('admin.')
                ->prefix('admin')
                ->group(base_path('routes/admin.php'));



            Route::middleware(['web', 'auth'])
                ->as('seeker.')
                ->prefix('seeker')
                ->group(base_path('routes/seeker.php'));


            Route::middleware(['web', 'auth'])
                ->as('provider.')
                ->prefix('provider')
                ->group(base_path('routes/provider.php'));

        });
    }
}
