<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Agregar 'rol' al fillable
    protected $fillable = [
        'name',
        'email',
        'password',
        'rol', 
    ];

    // Relación: Un usuario tiene muchas reservas
    public function reservas(): HasMany
    {
        return $this->hasMany(Reserva::class, 'usuario_id');
    }

    // Método para verificar si el usuario es profesor
    public function esProfesor(): bool
    {
        return $this->rol === 'profesor';
    }

    // Método para verificar si el usuario es alumno
    public function esAlumno(): bool
    {
        return $this->rol === 'alumno';
    }
}
