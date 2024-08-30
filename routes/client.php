<?php

use Illuminate\Support\Facades\Route;

Route::get('/perfil', function () {
    return view('cliente.panel');
})->name('cliente.perfil');
