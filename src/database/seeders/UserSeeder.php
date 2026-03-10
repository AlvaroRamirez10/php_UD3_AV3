<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = [
            // Profesores
            [
                'name' => 'Profesor García',
                'email' => 'profesor@biblioteca.com',
                'password' => Hash::make('12345678'),
                'rol' => 'profesor',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Profesora Martínez',
                'email' => 'profesora@biblioteca.com',
                'password' => Hash::make('12345678'),
                'rol' => 'profesor',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Alumnos
            [
                'name' => 'Juan Pérez',
                'email' => 'juan@alumno.com',
                'password' => Hash::make('12345678'),
                'rol' => 'alumno',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'María López',
                'email' => 'maria@alumno.com',
                'password' => Hash::make('12345678'),
                'rol' => 'alumno',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Carlos Rodríguez',
                'email' => 'carlos@alumno.com',
                'password' => Hash::make('12345678'),
                'rol' => 'alumno',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ana González',
                'email' => 'ana@alumno.com',
                'password' => Hash::make('12345678'),
                'rol' => 'alumno',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($usuarios);
    }
}
