<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;
use App\Models\Autor;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Usamos with('autor') para que en la lista aparezca el nombre del autor, no solo el ID
        $libros = Libro::with('autor')->get();
        return view('libros.index', compact('libros'));
    }

    /**
     * Show the form for creating a new resource.
            */
    public function create()
    {
        //
        $autores = Autor::all();
        return view('libros.create', compact('autores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor_id' => 'required|exists:autores,id',
            'isbn' => 'required|string|unique:libros,isbn',
            'anio_publicacion' => 'nullable|integer',
        ]);
        Libro::create($validatedData);
        return redirect()->route('libros.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Libro $libro)
    {
        //
        return view('libros.show', compact('libro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Libro $libro)
    {
        //
        $autores = Autor::all();
        return view('libros.edit', compact('libro', 'autores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Libro $libro)
    {
        //
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor_id' => 'required|exists:autores,id',
            'isbn' => 'required|string|unique:libros,isbn,' . $libro->id,
            'anio_publicacion' => 'nullable|integer',
        ]);
        $libro->update($validatedData);
        return redirect()->route('libros.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Libro $libro)
    {
        //
        $libro->delete();
        return redirect()->route('libros.index');
    }
}
