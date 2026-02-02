<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Libro</title>
</head>
<body>
    <h1>Registrar Libro</h1>
    <form action="{{ route('libros.store') }}" method="POST">
        @csrf
        <label>Título:</label><br>
        <input type="text" name="titulo" required><br><br>

        <label>Género:</label><br>
        <input type="text" name="genero" required><br><br>

        <label>Páginas:</label><br>
        <input type="number" name="paginas" required><br><br>

        <label>Autor:</label><br>
        <select name="autor_id" required>
            <option value="">-- Selecciona un autor --</option>
            @foreach($autores as $autor)
                <option value="{{ $autor->id }}">{{ $autor->nombre }} {{ $autor->apellidos }}</option>
            @endforeach
        </select><br><br>

        <button type="submit">Guardar Libro</button>
    </form>
</body>
</html>