<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfesorController extends Controller
{
    // Mostrar todas las reservas
    public function todasLasReservas()
    {
        $reservas = Reserva::with(['usuario', 'libro'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('profesor.todas-reservas', compact('reservas'));
    }

    // Mostrar reservas por periodo
    public function reservasPorPeriodo(Request $request)
    {
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');

        $query = Reserva::with(['usuario', 'libro']);

        if ($fechaInicio && $fechaFin) {
            $query->whereBetween('fecha_inicio', [$fechaInicio, $fechaFin])
                  ->orWhereBetween('fecha_fin', [$fechaInicio, $fechaFin]);
        }

        $reservas = $query->orderBy('created_at', 'desc')->get();

        return view('profesor.reservas-periodo', compact('reservas', 'fechaInicio', 'fechaFin'));
    }

    // Mostrar formulario para editar/confirmar una reserva
    public function editarReserva($id)
    {
        $reserva = Reserva::with(['usuario', 'libro'])->findOrFail($id);
        
        return view('profesor.editar-reserva', compact('reserva'));
    }

    // Actualizar el estado de una reserva (confirmar recogida)
    public function actualizarReserva(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,confirmada,entregada',
        ], [
            'estado.required' => 'Debes seleccionar un estado.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ]);

        DB::beginTransaction();

        try {
            $reserva = Reserva::with('libro')->findOrFail($id);
            $estadoAnterior = $reserva->estado;
            $estadoNuevo = $request->estado;

            // Si se confirma la recogida, guardar la fecha
            if ($estadoNuevo === 'confirmada' && $estadoAnterior !== 'confirmada') {
                $reserva->fecha_recogida = now();
            }

            // Si se marca como entregada (libro devuelto), devolver el libro al inventario
            if ($estadoNuevo === 'entregada' && $estadoAnterior !== 'entregada') {
                $libro = $reserva->libro;
                $libro->cantidad_disponible = $libro->cantidad_disponible + 1;
                $libro->save();
            }

            // Si se cambia de entregada a otro estado, restar del inventario
            if ($estadoAnterior === 'entregada' && $estadoNuevo !== 'entregada') {
                $libro = $reserva->libro;
                $libro->cantidad_disponible = $libro->cantidad_disponible - 1;
                $libro->save();
            }

            $reserva->estado = $estadoNuevo;
            $reserva->save();

            DB::commit();

            return redirect()->route('profesor.todas-reservas')
                ->with('success', 'Reserva actualizada correctamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Hubo un error al actualizar la reserva. Inténtalo de nuevo.');
        }
    }

    // Mostrar informe de préstamos no entregados
    public function prestamosNoEntregados()
    {
        $reservas = Reserva::with(['usuario', 'libro'])
            ->where('estado', '!=', 'entregada')
            ->orderBy('fecha_inicio', 'asc')
            ->get();
        
        return view('profesor.prestamos-no-entregados', compact('reservas'));
    }
}
