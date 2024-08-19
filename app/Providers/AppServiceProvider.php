<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->instance(RegisterResponse::class, new class implements RegisterResponse
        {
            public function toResponse($request)
            {

                return redirect('/dashboard');
            }
        });

        $this->app->instance(LoginResponse::class, new class implements LoginResponse
        {
            public function toResponse($request)
            {



                if (Auth::check()) {

                    $user = Auth::user();


                    if ($user->idtipo_usuario == 1) {

                        return redirect('/administrador');
                    } else if ($user->idtipo_usuario == 2) {

                        return redirect()->route('client.panel');
                    } else if ($user->idtipo_usuario == '3') {

                        return redirect()->route('gestor.panel');
                    }
                } else {
                    return redirect('/login');
                }
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
