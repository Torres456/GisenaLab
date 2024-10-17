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

Route::get('/catalogo/descripcion_muestra', function () {
    return view('administrador.catalogos.descripcion_muestra');
})->name('catalogos.descripcion_muetras');

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

Route::get('/catalogo/tipo_empleado', function () {
    return view('administrador.catalogos.tipo_empleado');
})->name('catalogos.tipo_empleado');

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

Route::get('/catalogo/roles_empleados', function () {
    return view('administrador.catalogos.tipo_empleado');
})->name('catalogos.tipo_empleado');

Route::get('/orden_servicio', function () {
    return view('administrador.ordenes');
})->name('administrador.ordenes');



Route::get('registro/gestores', function () {
    return view('administrador.registros.gestores');
})->name('registros.gestores');

Route::get('registro/interesados', function () {
    return view('administrador.registros.interesados');
})->name('registros.interesados');

Route::get('registro/clientes', function () {
    return view('administrador.registros.clientes');
})->name('registros.clientes');

Route::get('registro/empleados', function () {
    return view('administrador.registros.empleados');
})->name('registros.empleados');



Route::get('/ordenes', function () {
    return view('administrador.ordenes.ordenes');
})->name('ordenes.ordenes');

Route::get('/ordenes/create', function () {
    return view('administrador.ordenes.new_register');
})->name('ordenes.new_register');

Route::get('/ordenes/create/{id}/muestras', function ($id) {
    return view('administrador.ordenes.new_muestras', ['orderId' => $id]);
})->name('ordenes.new_muestras');


Route::get('/ordenes/{id}/edit/', function ($id) {
    return view('administrador.ordenes.edit_register', ['orderId' => $id]);
})->name('ordenes.edit_register');


Route::get('flujos/flujos_muestras', function () {
    return view('administrador.flujos.flujo_muestras');
})->name('flujos.flujo_muestras');
