<?php

use Illuminate\Support\Facades\Route;

Route::get('/panel', function () {
    return view('administrador.panel');
})->name('administrador.panel');

Route::get('/catalogos', function () {
    return view('administrador.catalogos.index');
})->name('catalogos.index');





Route::get('/catalogo/unidad_medidas', function () {
    return view('administrador.catalogos.unidad_medida');
})->name('catalogos.unidad_medida');

Route::get('/catalogo/unidad_metodo', function () {
    return view('administrador.catalogos.unidad_metodo');
})->name('catalogos.unidad_metodo');

Route::get('/catalogo/metodos', function () {
    return view('administrador.catalogos.metodos');
})->name('catalogos.metodos');

Route::get('/catalogo/categorias', function () {
    return view('administrador.catalogos.categorias');
})->name('catalogos.categorias');

Route::get('/catalogo/subcategorias', function () {
    return view('administrador.catalogos.subcategorias');
})->name('catalogos.subcategorias');

Route::get('/catalogo/tipo_muetras', function () {
    return view('administrador.catalogos.tipo_muestras');
})->name('catalogos.tipo_muestras');

Route::get('/catalogo/tipo_analisis', function () {
    return view('administrador.catalogos.tipo_analisis');
})->name('catalogos.tipo_analisis');

Route::get('/catalogo/analisi_esoecificos', function () {
    return view('administrador.catalogos.analisis_especifico');
})->name('catalogos.analisis_especifico');

Route::get('/catalogo/contenedores', function () {
    return view('administrador.catalogos.contenedores');
})->name('catalogos.contenedores');

Route::get('/catalogo/recipientes', function () {
    return view('administrador.catalogos.recipientes');
})->name('catalogos.recipientes');

Route::get('/catalogo/estatus_orden_servicio', function () {
    return view('administrador.catalogos.status_orden_servicio');
})->name('catalogos.status_orden_servicio');

Route::get('/catalogo/estatus_muestra', function () {
    return view('administrador.catalogos.status_muestra');
})->name('catalogos.status_muestra');

Route::get('/catalogo/laboratorios', function () {
    return view('administrador.catalogos.laboratorios');
})->name('catalogos.laboratorios');

Route::get('/catalogo/datos_muestra', function () {
    return view('administrador.catalogos.datos_muestra');
})->name('catalogos.datos_muestra');

Route::get('/catalogo/estados', function () {
    return view('administrador.direcciones.estados');
})->name('direcciones.estados');

Route::get('/catalogo/municipios', function () {
    return view('administrador.direcciones.municipios');
})->name('direcciones.municipios');

Route::get('/catalogo/colonias', function () {
    return view('administrador.direcciones.colonias');
})->name('direcciones.colonias');

Route::get('/catalogo/sucursales', function () {
    return view('administrador.direcciones.sucursales');
})->name('direcciones.sucursales');

Route::get('/catalogo/procedencias', function () {
    return view('administrador.direcciones.procedencias');
})->name('direcciones.procedencias');

Route::get('/catalogo/representacion', function () {
    return view('administrador.direcciones.representacion');
})->name('direcciones.representacion');

Route::get('/catalogo/rutas', function () {
    return view('rutas.index');
})->name('drutas.index');

Route::get('/orden_servicio', function () {
    return view('administrador.ordenes');
})->name('administrador.ordenes');

Route::get('/gestores', function () {
    return view('administrador.gestores');
})->name('administrador.gestores');

Route::get('/interesados', function () {
    return view('administrador.interesados');
})->name('administrador.interesados');

Route::get('/clientes', function () {
    return view('administrador.clientes');
})->name('administrador.clientes');

Route::get('/empleados', function () {
    return view('administrador.empleados');
})->name('administrador.empleados');

