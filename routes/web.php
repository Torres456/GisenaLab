<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;

//web
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/pruevas', function () {
    return view('pruevas');
})->name('pruevas');

//email
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'email',
])->group(function () {
    Route::get('/cambio-correo', function () {
        return view('auth.cambio-email');
    })->name('cambio-correo');
});

//password
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['correo' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('correo')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['correo' => __($status)]);
})->middleware('guest')->name('password.email');

Route::group(['middleware' => 'web'], function () {
    Route::fallback(function () {
        return view('errors.404');
    });
});

//profile
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
])->group(function () {
    Route::get('/admin/perfil', [UserProfileController::class, 'show'])->name('admin.perfil.show');
});
