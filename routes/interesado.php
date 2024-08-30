<?php

use Illuminate\Support\Facades\Route;

Route::get('/perfil', function () {
    return view('interesado.panel');
})->name('interesado.perfil');
