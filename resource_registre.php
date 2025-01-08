<html lang="es">
<head>
    <title>Registro - TDIW</title>
</head>
<body>
    <form method="post" action="controller/almacenar_registro.php">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>

        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required>
        <br>

        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña" required>
        <br>

        <button type="submit">Registrar</button>
    </form>
</body>
</html>