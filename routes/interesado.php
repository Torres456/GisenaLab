<?php

use Illuminate\Support\Facades\Route;

Route::get('/panel', function () {
    return view('interesado.panel');
})->name('panel'); 