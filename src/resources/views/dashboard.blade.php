<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel Principal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">
                        ¡Bienvenido, {{ auth()->user()->name }}!
                    </h3>

                    @if(auth()->user()->esProfesor())
                        <!-- Panel para profesores -->
                        <div class="mb-6">
                            <p class="text-lg mb-4">Eres un <strong>Profesor</strong>. Tienes acceso a:</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <a href="{{ route('profesor.todas-reservas') }}" 
                                   class="block p-6 bg-blue-100 border border-blue-300 rounded-lg hover:bg-blue-200 transition">
                                    <h4 class="text-xl font-bold mb-2">📚 Todas las Reservas</h4>
                                    <p class="text-gray-700">Gestiona todas las reservas realizadas</p>
                                </a>

                                <a href="{{ route('profesor.reservas-periodo') }}" 
                                   class="block p-6 bg-green-100 border border-green-300 rounded-lg hover:bg-green-200 transition">
                                    <h4 class="text-xl font-bold mb-2">📅 Reservas por Periodo</h4>
                                    <p class="text-gray-700">Consulta reservas en un rango de fechas</p>
                                </a>

                                <a href="{{ route('profesor.prestamos-no-entregados') }}" 
                                   class="block p-6 bg-yellow-100 border border-yellow-300 rounded-lg hover:bg-yellow-200 transition">
                                    <h4 class="text-xl font-bold mb-2">⚠️ Préstamos No Entregados</h4>
                                    <p class="text-gray-700">Libros que aún no han sido devueltos</p>
                                </a>

                            </div>
                        </div>
                    @else
                        <!-- Panel para alumnos -->
                        <div class="mb-6">
                            <p class="text-lg mb-4">Eres un <strong>Alumno</strong>. Puedes:</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <a href="{{ route('libros.index') }}" 
                                   class="block p-6 bg-blue-100 border border-blue-300 rounded-lg hover:bg-blue-200 transition">
                                    <h4 class="text-xl font-bold mb-2">📚 Ver Libros Disponibles</h4>
                                    <p class="text-gray-700">Explora el catálogo y reserva libros</p>
                                </a>

                                <a href="{{ route('reservas.mis-reservas') }}" 
                                   class="block p-6 bg-green-100 border border-green-300 rounded-lg hover:bg-green-200 transition">
                                    <h4 class="text-xl font-bold mb-2">📋 Mis Reservas</h4>
                                    <p class="text-gray-700">Consulta el estado de tus reservas</p>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
