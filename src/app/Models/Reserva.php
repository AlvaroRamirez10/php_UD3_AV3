<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reserva extends Model
{
    // Nombre de la tabla
    protected $table = 'reservas';

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'usuario_id',
        'libro_id',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'fecha_recogida',
    ];

    // Convertir estas columnas a objetos Carbon (fechas)
    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'fecha_recogida' => 'date',
    ];

    // Relación: Una reserva pertenece a un usuario
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    // Relación: Una reserva pertenece a un libro
    public function libro(): BelongsTo
    {
        return $this->belongsTo(Libro::class, 'libro_id');
    }
}
