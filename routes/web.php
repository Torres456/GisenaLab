<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

//web
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// auth
Route::get('/tipo-persona', function () {
    return view('auth.tipo-persona');
})->middleware(['guest:' . config('fortify.guard')])->name('tipo-persona');

Route::get('/registro-persona-fisica', function () {
    return view('auth.registro-fisica');
})->middleware(['guest:' . config('fortify.guard')])->name('persona-fisica');

Route::get('/registro-persona-moral', function () {
    return view('auth.registro-moral');
})->middleware(['guest:' . config('fortify.guard')])->name('persona-moral');

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


