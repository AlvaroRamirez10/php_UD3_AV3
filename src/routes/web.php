<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ProfesorController;
use Illuminate\Support\Facades\Route;

// Ruta principal - redirige al login o dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard - accesible para usuarios autenticados
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas con autenticación
Route::middleware('auth')->group(function () {
    
    // Rutas del perfil de usuario (de Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //  RUTAS PARA ALUMNOS
    
    // Ver listado de libros disponibles
    Route::get('/libros', [LibroController::class, 'index'])->name('libros.index');
    
    // Ver formulario de reserva para un libro específico
    Route::get('/libros/{id}/reservar', [LibroController::class, 'mostrarFormularioReserva'])
        ->name('libros.reservar');
    
    // Guardar la reserva
    Route::post('/reservas', [ReservaController::class, 'guardar'])->name('reservas.guardar');
    
    // Ver mis reservas
    Route::get('/mis-reservas', [ReservaController::class, 'misReservas'])
        ->name('reservas.mis-reservas');

    // RUTAS SOLO PARA PROFESORES 
    
    Route::middleware('verificar.profesor')->group(function () {
        
        // Ver todas las reservas
        Route::get('/profesor/reservas', [ProfesorController::class, 'todasLasReservas'])
            ->name('profesor.todas-reservas');
        
        // Ver reservas por periodo
        Route::get('/profesor/reservas-periodo', [ProfesorController::class, 'reservasPorPeriodo'])
            ->name('profesor.reservas-periodo');
        
        // Editar/confirmar una reserva
        Route::get('/profesor/reservas/{id}/editar', [ProfesorController::class, 'editarReserva'])
            ->name('profesor.editar-reserva');
        
        // Actualizar el estado de una reserva
        Route::put('/profesor/reservas/{id}', [ProfesorController::class, 'actualizarReserva'])
            ->name('profesor.actualizar-reserva');
        
        // Informe de préstamos no entregados
        Route::get('/profesor/prestamos-no-entregados', [ProfesorController::class, 'prestamosNoEntregados'])
            ->name('profesor.prestamos-no-entregados');
    });
});

// Rutas de autenticación de Breeze
require __DIR__.'/auth.php';
