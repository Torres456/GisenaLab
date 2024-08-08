<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Mail\VerifiMailable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// auth
Route::get('/tipo-persona', function () {
    return view('auth.tipo-persona');
})->name('tipo-persona');

Route::get('/registro-persona-fisica', function () {
    return view('auth.registro-fisica');
})->name('persona-fisica');

Route::get('/registro-persona-moral', function () {
    return view('auth.registro-moral');
})->name('persona-moral');

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


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
])->group(function () {
    Route::get('/administrador', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/catalogos', function () {
        return view('catalogos.index');
    })->name('catalogos.index');


    Route::get('/catalogo/categorias', function () {
        return view('catalogos.categorias');
    })->name('catalogos.categorias');

    Route::get('/catalogo/subcategorias', function () {
        return view('catalogos.subcategorias');
    })->name('catalogos.subcategorias');

    Route::get('/catalogo/tipo_muetras', function () {
        return view('catalogos.tipo_muestras');
    })->name('catalogos.tipo_muestras');

    Route::get('/catalogo/tipo_analisis', function () {
        return view('catalogos.tipo_analisis');
    })->name('catalogos.tipo_analisis');

    Route::get('/catalogo/analisi_esoecificos', function () {
        return view('catalogos.analisis_especifico');
    })->name('catalogos.analisis_especifico');

    Route::get('/catalogo/metodos', function () {
        return view('catalogos.metodos');
    })->name('catalogos.metodos');

    Route::get('/catalogo/unidad_metodo', function () {
        return view('catalogos.unidad_metodo');
    })->name('catalogos.unidad_metodo');

    Route::get('/catalogo/unidad_medidas', function () {
        return view('catalogos.unidad_medida');
    })->name('catalogos.unidad_medida');

    Route::get('/catalogo/contenedores', function () {
        return view('catalogos.contenedores');
    })->name('catalogos.contenedores');

    Route::get('/catalogo/recipientes', function () {
        return view('catalogos.recipientes');
    })->name('catalogos.recipientes');

    Route::get('/catalogo/estatus_orden_servicio', function () {
        return view('catalogos.status_orden_servicio');
    })->name('catalogos.status_orden_servicio');

    Route::get('/catalogo/estatus_muestra', function () {
        return view('catalogos.status_muestra');
    })->name('catalogos.status_muestra');

    Route::get('/catalogo/laboratorios', function () {
        return view('catalogos.laboratorios');
    })->name('catalogos.laboratorios');

    Route::get('/catalogo/datos_muestra', function () {
        return view('catalogos.datos_muestra');
    })->name('catalogos.datos_muestra');

    Route::get('/catalogo/estados', function () {
        return view('direcciones.estados');
    })->name('direcciones.estados');

    Route::get('/catalogo/municipios', function () {
        return view('direcciones.municipios');
    })->name('direcciones.municipios');

    Route::get('/catalogo/colonias', function () {
        return view('direcciones.colonias');
    })->name('direcciones.colonias');

    Route::get('/catalogo/sucursales', function () {
        return view('direcciones.sucursales');
    })->name('direcciones.sucursales');

    Route::get('/catalogo/procedencias', function () {
        return view('direcciones.procedencias');
    })->name('direcciones.procedencias');

    Route::get('/catalogo/rutas', function () {
        if (auth()->user()->correo == 'lued1006@gmail.com') {
            return view('rutas.index');
        } else {
            abort(404);
        }
    })->name('rutas.index');
});
