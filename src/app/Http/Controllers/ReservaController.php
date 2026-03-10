<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservaController extends Controller
{
    // Mostrar las reservas del alumno autenticado
    public function misReservas()
    {
        $reservas = Reserva::where('usuario_id', auth()->id())
            ->with('libro')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('reservas.mis-reservas', compact('reservas'));
    }

    // Guardar una nueva reserva
    public function guardar(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'libro_id' => 'required|exists:libros,id',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'required|date|after:fecha_inicio',
        ], [
            'libro_id.required' => 'Debes seleccionar un libro.',
            'libro_id.exists' => 'El libro seleccionado no existe.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.after_or_equal' => 'La fecha de inicio debe ser hoy o posterior.',
            'fecha_fin.required' => 'La fecha de fin es obligatoria.',
            'fecha_fin.after' => 'La fecha de fin debe ser posterior a la fecha de inicio.',
        ]);

        // Usar transacción para asegurar consistencia
        DB::beginTransaction();
        
        try {
            // Buscar el libro
            $libro = Libro::findOrFail($request->libro_id);

            // Verificar disponibilidad del libro para el periodo solicitado
            if (!$libro->estaDisponible($request->fecha_inicio, $request->fecha_fin)) {
                DB::rollBack();
                return redirect()->back()
                    ->with('error', 'El libro no está disponible para el periodo seleccionado.')
                    ->withInput();
            }

            // Verificar que hay libros disponibles
            if ($libro->cantidad_disponible <= 0) {
                DB::rollBack();
                return redirect()->back()
                    ->with('error', 'No hay ejemplares disponibles de este libro.')
                    ->withInput();
            }

            // Crear la reserva
            Reserva::create([
                'usuario_id' => auth()->id(),
                'libro_id' => $request->libro_id,
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_fin' => $request->fecha_fin,
                'estado' => 'pendiente',
            ]);

            // Restar un libro disponible
            $libro->cantidad_disponible = $libro->cantidad_disponible - 1;
            $libro->save();

            DB::commit();

            return redirect()->route('reservas.mis-reservas')
                ->with('success', 'Reserva realizada correctamente. Puedes recoger el libro en la fecha indicada.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Hubo un error al procesar la reserva. Inténtalo de nuevo.')
                ->withInput();
        }
    }
}