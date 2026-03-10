<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('libro_id')->constrained('libros')->onDelete('cascade');
            $table->date('fecha_inicio'); // Fecha desde cuando necesita el libro
            $table->date('fecha_fin'); // Fecha hasta cuando lo necesita
            $table->enum('estado', ['pendiente', 'confirmada', 'entregada'])->default('pendiente');
            $table->date('fecha_recogida')->nullable(); // Cuando el profesor confirma la entrega
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
