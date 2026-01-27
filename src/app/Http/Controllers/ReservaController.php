<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $reservas = Reserva::all();
        return view('reservas.index', compact('reservas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('reservas.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'libro_id' => 'required|exists:libros,id',
            'fecha_reserva' => 'required|date',
            'fecha_devolucion' => 'nullable|date|after_or_equal:fecha_reserva',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reserva $reserva)
    {
        //
        return view('reservas.show', compact('reserva'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reserva $reserva)
    {
        //
        return view('reservas.edit', compact('reserva'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reserva $reserva)
    {
        //
        $validatedData = $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'libro_id' => 'required|exists:libros,id',
            'fecha_reserva' => 'required|date',
            'fecha_devolucion' => 'nullable|date|after_or_equal:fecha_reserva',
        ]);
        $reserva->update($validatedData);
        return redirect()->route('reservas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserva $reserva)
    {
        //
        $reserva->delete();
        return redirect()->route('reservas.index');
    }
}
