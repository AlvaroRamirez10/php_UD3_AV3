<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    //
    protected $fillable = ['alumno_id', 'libro_id', 'fecha_reserva', 'fecha_devolucion'];
}
