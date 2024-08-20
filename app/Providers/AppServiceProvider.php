<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
