<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\ReservaController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('autores', AutorController::class);
Route::resource('libros', LibroController::class);
Route::resource('alumnos', AlumnoController::class);
Route::resource('reservas', ReservaController::class);