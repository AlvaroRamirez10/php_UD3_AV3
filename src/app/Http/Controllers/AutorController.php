<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $autores = Autor::all();
        return view('autores.index', compact('autores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('autores.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'biografia' => 'nullable|string',
        ]);
        Autor::create($validatedData);
        return redirect()->route('autores.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Autor $autor)
    {
        //
        return view('autores.show', compact('autor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Autor $autor)
    {
        //
        $autores = Autor::all();
        return view('autores.edit', compact('autor', 'autores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Autor $autor)
    {
        //
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'biografia' => 'nullable|string',
        ]);
        $autor->update($validatedData);
        return redirect()->route('autores.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Autor $autor)
    {
        //
        $autor->delete();
        return redirect()->route('autores.index');
    }
}
