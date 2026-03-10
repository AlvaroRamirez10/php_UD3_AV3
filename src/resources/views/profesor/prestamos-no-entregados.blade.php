<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Préstamos No Entregados') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="mb-4 p-4 bg-yellow-100 border border-yellow-400 rounded">
                        <p class="text-yellow-800">
                            <strong>⚠️ Informe:</strong> Este listado muestra todos los libros que aún no han sido devueltos 
                            (estado "Pendiente" o "Confirmada").
                        </p>
                    </div>

                    @if($reservas->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-300">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="py-3 px-4 border-b text-left">ID</th>
                                        <th class="py-3 px-4 border-b text-left">Alumno</th>
                                        <th class="py-3 px-4 border-b text-left">Email</th>
                                        <th class="py-3 px-4 border-b text-left">Libro</th>
                                        <th class="py-3 px-4 border-b text-left">Fecha Inicio</th>
                                        <th class="py-3 px-4 border-b text-left">Fecha Fin</th>
                                        <th class="py-3 px-4 border-b text-left">Estado</th>
                                        <th class="py-3 px-4 border-b text-left">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reservas as $reserva)
                                        <tr class="hover:bg-gray-50 {{ $reserva->fecha_fin->isPast() ? 'bg-red-50' : '' }}">
                                            <td class="py-3 px-4 border-b">{{ $reserva->id }}</td>
                                            <td class="py-3 px-4 border-b">{{ $reserva->usuario->name }}</td>
                                            <td class="py-3 px-4 border-b text-sm">{{ $reserva->usuario->email }}</td>
                                            <td class="py-3 px-4 border-b">
                                                <strong>{{ $reserva->libro->titulo }}</strong><br>
                                                <span class="text-sm text-gray-600">{{ $reserva->libro->autor }}</span>
                                            </td>
                                            <td class="py-3 px-4 border-b">{{ $reserva->fecha_inicio->format('d/m/Y') }}</td>
                                            <td class="py-3 px-4 border-b">
                                                {{ $reserva->fecha_fin->format('d/m/Y') }}
                                                @if($reserva->fecha_fin->isPast())
                                                    <br><span class="text-red-600 text-sm font-bold">¡VENCIDO!</span>
                                                @endif
                                            </td>
                                            <td class="py-3 px-4 border-b">
                                                @if($reserva->estado === 'pendiente')
                                                    <span class="bg-yellow-200 text-yellow-800 py-1 px-3 rounded-full text-sm">
                                                        Pendiente
                                                    </span>
                                                @else
                                                    <span class="bg-green-200 text-green-800 py-1 px-3 rounded-full text-sm">
                                                        Confirmada
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="py-3 px-4 border-b">
                                                <a href="{{ route('profesor.editar-reserva', $reserva->id) }}" 
                                                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                    Gestionar
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-4">
                            <p class="text-gray-600">
                                <strong>Total de préstamos pendientes:</strong> {{ $reservas->count() }}
                            </p>
                            <p class="text-sm text-gray-500 mt-2">
                                * Las filas en rojo indican que la fecha de fin ya ha pasado.
                            </p>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-green-600 text-lg font-bold">✓ ¡Excelente!</p>
                            <p class="text-gray-500 text-lg mt-2">Todos los libros han sido devueltos.</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>