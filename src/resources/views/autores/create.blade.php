<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Autor</title>
</head>
<body>
    <h1>Añadir un Autor</h1>
    <form action="{{ route('autores.store') }}" method="POST">
        @csrf
        <input type="text" name="nombre" placeholder="Nombre" required><br><br>
        <input type="text" name="apellidos" placeholder="Apellidos" required><br><br>
        <input type="text" name="nacionalidad" placeholder="Nacionalidad" required><br><br>
        <button type="submit">Guardar Autor</button>
    </form>
    
</body>
</html>