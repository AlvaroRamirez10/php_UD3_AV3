<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Consultar Reservas por Periodo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Formulario de filtro -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-4">Filtrar por Periodo</h3>
                    
                    <form action="{{ route('profesor.reservas-periodo') }}" method="GET" class="flex flex-wrap gap-4 items-end">
                        <div class="flex-1 min-w-[200px]">
                            <label for="fecha_inicio" class="block text-gray-700 font-bold mb-2">
                                Fecha Inicio
                            </label>
                            <input type="date" 
                                   id="fecha_inicio" 
                                   name="fecha_inicio" 
                                   value="{{ $fechaInicio }}"
                                   class="border border-gray-300 rounded w-full py-2 px-3 focus:outline-none focus:border-blue-500">
                        </div>

                        <div class="flex-1 min-w-[200px]">
                            <label for="fecha_fin" class="block text-gray-700 font-bold mb-2">
                                Fecha Fin
                            </label>
                            <input type="date" 
                                   id="fecha_fin" 
                                   name="fecha_fin" 
                                   value="{{ $fechaFin }}"
                                   class="border border-gray-300 rounded w-full py-2 px-3 focus:outline-none focus:border-blue-500">
                        </div>

                        <div>
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Buscar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Resultados -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if($fechaInicio && $fechaFin)
                        <h3 class="text-lg font-bold mb-4">
                            Resultados del {{ \Carbon\Carbon::parse($fechaInicio)->format('d/m/Y') }} 
                            al {{ \Carbon\Carbon::parse($fechaFin)->format('d/m/Y') }}
                        </h3>
                    @else
                        <h3 class="text-lg font-bold mb-4">Todas las Reservas</h3>
                    @endif

                    @if($reservas->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-300">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="py-3 px-4 border-b text-left">ID</th>
                                        <th class="py-3 px-4 border-b text-left">Alumno</th>
                                        <th class="py-3 px-4 border-b text-left">Libro</th>
                                        <th class="py-3 px-4 border-b text-left">Fecha Inicio</th>
                                        <th class="py-3 px-4 border-b text-left">Fecha Fin</th>
                                        <th class="py-3 px-4 border-b text-left">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reservas as $reserva)
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-3 px-4 border-b">{{ $reserva->id }}</td>
                                            <td class="py-3 px-4 border-b">{{ $reserva->usuario->name }}</td>
                                            <td class="py-3 px-4 border-b">
                                                <strong>{{ $reserva->libro->titulo }}</strong><br>
                                                <span class="text-sm text-gray-600">{{ $reserva->libro->autor }}</span>
                                            </td>
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
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-4 text-right">
                            <p class="text-gray-600">
                                <strong>Total de reservas encontradas:</strong> {{ $reservas->count() }}
                            </p>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500 text-lg">No se encontraron reservas para este periodo.</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>