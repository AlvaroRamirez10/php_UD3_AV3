<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Reserva') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Información de la reserva -->
                    <div class="mb-6 p-4 bg-gray-100 rounded-lg">
                        <h3 class="text-xl font-bold mb-3">Información de la Reserva</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-gray-700"><strong>ID Reserva:</strong> {{ $reserva->id }}</p>
                                <p class="text-gray-700"><strong>Alumno:</strong> {{ $reserva->usuario->name }}</p>
                                <p class="text-gray-700"><strong>Email:</strong> {{ $reserva->usuario->email }}</p>
                            </div>
                            <div>
                                <p class="text-gray-700"><strong>Libro:</strong> {{ $reserva->libro->titulo }}</p>
                                <p class="text-gray-700"><strong>Autor:</strong> {{ $reserva->libro->autor }}</p>
                                <p class="text-gray-700"><strong>ISBN:</strong> {{ $reserva->libro->isbn }}</p>
                            </div>
                        </div>

                        <div class="mt-4 pt-4 border-t border-gray-300">
                            <p class="text-gray-700"><strong>Periodo de préstamo:</strong> 
                                {{ $reserva->fecha_inicio->format('d/m/Y') }} - {{ $reserva->fecha_fin->format('d/m/Y') }}
                            </p>
                            <p class="text-gray-700"><strong>Estado actual:</strong> 
                                <span class="font-semibold">{{ ucfirst($reserva->estado) }}</span>
                            </p>
                            @if($reserva->fecha_recogida)
                                <p class="text-gray-700"><strong>Fecha de recogida:</strong> 
                                    {{ $reserva->fecha_recogida->format('d/m/Y') }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Mensajes de error -->
                    @if($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Formulario para cambiar el estado -->
                    <form action="{{ route('profesor.actualizar-reserva', $reserva->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label for="estado" class="block text-gray-700 font-bold mb-2">
                                Cambiar Estado de la Reserva *
                            </label>
                            <select name="estado" 
                                    id="estado" 
                                    class="border border-gray-300 rounded w-full py-2 px-3 focus:outline-none focus:border-blue-500"
                                    required>
                                <option value="pendiente" {{ $reserva->estado === 'pendiente' ? 'selected' : '' }}>
                                    Pendiente
                                </option>
                                <option value="confirmada" {{ $reserva->estado === 'confirmada' ? 'selected' : '' }}>
                                    Confirmada (Libro entregado al alumno)
                                </option>
                                <option value="entregada" {{ $reserva->estado === 'entregada' ? 'selected' : '' }}>
                                    Entregada (Libro devuelto)
                                </option>
                            </select>
                            <p class="text-sm text-gray-500 mt-2">
                                <strong>Pendiente:</strong> El alumno ha hecho la reserva pero aún no ha recogido el libro.<br>
                                <strong>Confirmada:</strong> El alumno ha recogido el libro (se registrará la fecha de recogida).<br>
                                <strong>Entregada:</strong> El alumno ha devuelto el libro.
                            </p>
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" 
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Guardar Cambios
                            </button>
                            <a href="{{ route('profesor.todas-reservas') }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancelar
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>