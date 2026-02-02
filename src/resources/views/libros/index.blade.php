<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca - Libros</title>
</head>
<body>

    <nav style="background: #eee; padding: 10px;">
        <a href="{{ route('autores.index') }}">Ver Autores</a> | 
        <a href="{{ route('autores.create') }}">Nuevo Autor</a> | 
        <a href="{{ route('libros.index') }}">Ver Libros</a> | 
        <a href="{{ route('libros.create') }}">Nuevo Libro</a>
    </nav>
    <hr>
    
    <h1>Mis Libros</h1>
    <a href="{{ route('libros.create') }}">Añadir Libro</a>
    <hr>
    <table border="1">
        <thead>
            <tr>
                <th>Título</th>
                <th>Género</th>
                <th>Páginas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($libros as $libro)
                <tr>
                    <td>{{ $libro->titulo }}</td>
                    <td>{{ $libro->genero }}</td>
                    <td>{{ $libro->paginas }}</td>
                    <td>
                        <a href="{{ route('libros.edit', $libro->id) }}">Editar</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">No hay libros en la base de datos.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>