<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Libro extends Model
{
    // Nombre de la tabla
    protected $table = 'libros';

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'titulo',
        'autor',
        'isbn',
        'descripcion',
        'cantidad_total',
        'cantidad_disponible',
    ];

    // Relación: Un libro tiene muchas reservas
    public function reservas(): HasMany
    {
        return $this->hasMany(Reserva::class, 'libro_id');
    }

    // Método para verificar si el libro está disponible en un periodo
    public function estaDisponible($fechaInicio, $fechaFin): bool
    {
        // Contar reservas confirmadas que se solapan con el periodo solicitado
        $reservasActivas = $this->reservas()
            ->where('estado', '!=', 'entregada')
            ->where(function ($query) use ($fechaInicio, $fechaFin) {
                $query->whereBetween('fecha_inicio', [$fechaInicio, $fechaFin])
                      ->orWhereBetween('fecha_fin', [$fechaInicio, $fechaFin])
                      ->orWhere(function ($q) use ($fechaInicio, $fechaFin) {
                          $q->where('fecha_inicio', '<=', $fechaInicio)
                            ->where('fecha_fin', '>=', $fechaFin);
                      });
            })
            ->count();

        return ($this->cantidad_disponible - $reservasActivas) > 0;
    }
}
