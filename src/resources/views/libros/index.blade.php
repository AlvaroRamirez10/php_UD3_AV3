<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Libros Disponibles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if($libros->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($libros as $libro)
                                <div class="border border-gray-300 rounded-lg p-4 hover:shadow-lg transition">
                                    <h3 class="text-xl font-bold mb-2">{{ $libro->titulo }}</h3>
                                    <p class="text-gray-600 mb-1"><strong>Autor:</strong> {{ $libro->autor }}</p>
                                    <p class="text-gray-600 mb-1"><strong>ISBN:</strong> {{ $libro->isbn }}</p>
                                    <p class="text-gray-600 mb-3">{{ $libro->descripcion }}</p>
                                    <p class="text-sm mb-4">
                                        <span class="font-semibold">Disponibles:</span> 
                                        <span class="text-green-600">{{ $libro->cantidad_disponible }}</span> / 
                                        {{ $libro->cantidad_total }}
                                    </p>
                                    
                                    <a href="{{ route('libros.reservar', $libro->id) }}" 
                                       class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Reservar Libro
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500 text-lg">No hay libros disponibles en este momento.</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>