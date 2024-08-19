<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
use Illuminate\Support\Facades\Auth;

class FortifyServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->instance(LoginResponse::class, new class implements LoginResponse
        {
            public function toResponse($request)
            {

                if (Auth::check()) {

                    $user = User::where('correo', $request->correo)->first();

                    if ($user->idtipo_usuario == '1') {

                        return redirect()->route('admin.administrador.panel');
                    } else if ($user->idtipo_usuario == '2') {

                        return redirect()->route('client.panel');
                    } else if ($user->idtipo_usuario == '3') {

                        return redirect()->route('gestor.panel');
                    } else {
                        abort(500);
                    }
                } else {
                    return redirect()->route('welcome');
                }
            }
        });

        $this->app->instance(RegisterResponse::class, new class implements RegisterResponse
        {
            public function toResponse($request)
            {

                if (Auth::check()) {

                    $user = User::where('correo', $request->correo)->first();

                    if ($user->idtipo_usuario == '1') {

                        return redirect()->route('admin.administrador.panel');
                    } else if ($user->idtipo_usuario == '2') {

                        return redirect()->route('cliente.panel');
                    } else {

                        abort(500);
                    }
                } else {
                    return redirect()->route('welcome');
                }
            }
        });

        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse
        {
            public function toResponse($request)
            {
                return redirect()->route('welcome');
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('correo', $request->correo)->first();

            if (
                $user && Hash::check($request->password, $user->contraseña) && $user->estatus == 1
            ) {
                return $user;
            }
        });



        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
