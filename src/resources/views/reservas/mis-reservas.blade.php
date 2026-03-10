<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Reservas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Mensaje de éxito -->
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($reservas->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-300">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="py-3 px-4 border-b text-left">Libro</th>
                                        <th class="py-3 px-4 border-b text-left">Autor</th>
                                        <th class="py-3 px-4 border-b text-left">Fecha Inicio</th>
                                        <th class="py-3 px-4 border-b text-left">Fecha Fin</th>
                                        <th class="py-3 px-4 border-b text-left">Estado</th>
                                        <th class="py-3 px-4 border-b text-left">Fecha Recogida</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reservas as $reserva)
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-3 px-4 border-b">{{ $reserva->libro->titulo }}</td>
                                            <td class="py-3 px-4 border-b">{{ $reserva->libro->autor }}</td>
                                            <td class="py-3 px-4 border-b">{{ $reserva->fecha_inicio->format('d/m/Y') }}</td>
                                            <td class="py-3 px-4 border-b">{{ $reserva->fecha_fin->format('d/m/Y') }}</td>
                                            <td class="py-3 px-4 border-b">
                                                @if($reserva->estado === 'pendiente')
                                                    <span class="bg-yellow-200 text-yellow-800 py-1 px-3 rounded-full text-sm">
                                                        Pendiente
                                                    </span>
                                                @elseif($reserva->estado === 'confirmada')
                                                    <span class="bg-green-200 text-green-800 py-1 px-3 rounded-full text-sm">
                                                        Confirmada
                                                    </span>
                                                @else
                                                    <span class="bg-blue-200 text-blue-800 py-1 px-3 rounded-full text-sm">
                                                        Entregada
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="py-3 px-4 border-b">
                                                {{ $reserva->fecha_recogida ? $reserva->fecha_recogida->format('d/m/Y') : 'No recogido' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500 text-lg mb-4">No tienes ninguna reserva todavía.</p>
                            <a href="{{ route('libros.index') }}" 
                               class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Ver Libros Disponibles
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>