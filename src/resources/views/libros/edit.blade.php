<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Libro</title>
</head>

<body>
    <h1>Editar Libro</h1>
    <form action="{{ route('libros.update', $libro->id) }}" method="POST">
        @csrf
        @method('PUT') <label>Título:</label>
        <input type="text" name="titulo" value="{{ $libro->titulo }}" required><br>

        <label>ISBN:</label>
        <input type="text" name="isbn" value="{{ $libro->isbn }}" required><br>

        <label>Autor:</label>
        <select name="autor_id" required>
            @foreach($autores as $autor)
            <option value="{{ $autor->id }}" {{ $libro->autor_id == $autor->id ? 'selected' : '' }}>
                {{ $autor->nombre }} {{ $autor->apellidos }}
            </option>
            @endforeach
        </select><br>

        <button type="submit">Actualizar</button>
    </form>
</body>

</html>