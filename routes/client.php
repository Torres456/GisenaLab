<?php

use App\Http\Middleware\AdminRole;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Mail\VerifiMailable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;


Route::get('/panel', function () {
    return 'cliente';
})->name('panel');
