<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reservar Libro') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Información del libro -->
                    <div class="mb-6 p-4 bg-gray-100 rounded-lg">
                        <h3 class="text-2xl font-bold mb-2">{{ $libro->titulo }}</h3>
                        <p class="text-gray-700"><strong>Autor:</strong> {{ $libro->autor }}</p>
                        <p class="text-gray-700"><strong>ISBN:</strong> {{ $libro->isbn }}</p>
                        <p class="text-gray-700 mt-2">{{ $libro->descripcion }}</p>
                        <p class="text-sm mt-3">
                            <span class="font-semibold">Disponibles:</span> 
                            <span class="text-green-600">{{ $libro->cantidad_disponible }}</span> ejemplares
                        </p>
                    </div>

                    <!-- Mensajes de error -->
                    @if(session('error'))
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Formulario de reserva -->
                    <form action="{{ route('reservas.guardar') }}" method="POST">
                        @csrf
                        <input type="hidden" name="libro_id" value="{{ $libro->id }}">

                        <div class="mb-4">
                            <label for="fecha_inicio" class="block text-gray-700 font-bold mb-2">
                                Fecha de Inicio *
                            </label>
                            <input type="date" 
                                   id="fecha_inicio" 
                                   name="fecha_inicio" 
                                   value="{{ old('fecha_inicio') }}"
                                   min="{{ date('Y-m-d') }}"
                                   class="border border-gray-300 rounded w-full py-2 px-3 focus:outline-none focus:border-blue-500"
                                   required>
                            <p class="text-sm text-gray-500 mt-1">Fecha desde cuando necesitas el libro</p>
                        </div>

                        <div class="mb-4">
                            <label for="fecha_fin" class="block text-gray-700 font-bold mb-2">
                                Fecha de Fin *
                            </label>
                            <input type="date" 
                                   id="fecha_fin" 
                                   name="fecha_fin" 
                                   value="{{ old('fecha_fin') }}"
                                   min="{{ date('Y-m-d') }}"
                                   class="border border-gray-300 rounded w-full py-2 px-3 focus:outline-none focus:border-blue-500"
                                   required>
                            <p class="text-sm text-gray-500 mt-1">Fecha hasta cuando necesitas el libro</p>
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Confirmar Reserva
                            </button>
                            <a href="{{ route('libros.index') }}" 
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