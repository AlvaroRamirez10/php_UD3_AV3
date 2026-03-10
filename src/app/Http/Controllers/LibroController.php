<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    // Mostrar listado de libros disponibles para reservar
    public function index()
    {
        $libros = Libro::where('cantidad_disponible', '>', 0)->get();
        
        return view('libros.index', compact('libros'));
    }

    // Mostrar formulario para crear reserva de un libro específico
    public function mostrarFormularioReserva($id)
    {
        $libro = Libro::findOrFail($id);
        
        return view('libros.reservar', compact('libro'));
    }
}