<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Passport::tokensCan([
            'user' => 'access user',
            'admin' => 'access admin',
            'writer' => 'access writer'
        ]);
        Passport::setDefaultScope([
            'user', // Default scope if none is specified
        ]);

        Passport::tokensExpireIn(Carbon::now()->addDays(10));  // Access token valid for 30 days
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30)); // Refresh token valid for 60 days
        Passport::personalAccessTokensExpireIn(Carbon::now()->addMonths(6));
    }
}
