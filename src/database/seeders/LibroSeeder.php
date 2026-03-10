<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LibroSeeder extends Seeder
{
    public function run(): void
    {
        $libros = [
            [
                'titulo' => 'Don Quijote de la Mancha',
                'autor' => 'Miguel de Cervantes',
                'isbn' => '978-8420412146',
                'descripcion' => 'Clásico de la literatura española',
                'cantidad_total' => 5,
                'cantidad_disponible' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Cien años de soledad',
                'autor' => 'Gabriel García Márquez',
                'isbn' => '978-0307474728',
                'descripcion' => 'Obra maestra del realismo mágico',
                'cantidad_total' => 3,
                'cantidad_disponible' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'La Celestina',
                'autor' => 'Fernando de Rojas',
                'isbn' => '978-8437604404',
                'descripcion' => 'Tragicomedia española del siglo XV',
                'cantidad_total' => 4,
                'cantidad_disponible' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'El principito',
                'autor' => 'Antoine de Saint-Exupéry',
                'isbn' => '978-0156012195',
                'descripcion' => 'Novela corta filosófica',
                'cantidad_total' => 6,
                'cantidad_disponible' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('libros')->insert($libros);
    }
}
