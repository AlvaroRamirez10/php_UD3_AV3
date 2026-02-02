<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Autores</title>
</head>

<body>
    <nav>
        <a href="{{ route('autores.index') }}">Ver Autores</a> |
        <a href="{{ route('autores.create') }}">Nuevo Autor</a> |
        <a href="{{ route('libros.index') }}">Ver Libros</a> |
        <a href="{{ route('libros.create') }}">Nuevo Libro</a>
    </nav>
    <hr>

    <h1>Autores Registrados</h1>
    <a href="{{ route('autores.create') }}">Añadir nuevo autor</a>
    <hr>
    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Nacionalidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach($autores as $autor)
            <tr>
                <td>{{ $autor->nombre }}</td>
                <td>{{ $autor->apellidos }}</td>
                <td>{{ $autor->nacionalidad }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>