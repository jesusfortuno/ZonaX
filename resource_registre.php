<html lang="es">
<head>
    <title>Registro - TDIW</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../scripts/verificar_email.js"></script>
</head>
<body>
    <form method="post" action="controller/almacenar_registro.php">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>

        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required>
        <span id="email_error" style="color: red;"></span>
        <br>

        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña" required>
        <br>

        <button type="submit">Registrar</button>
    </form>
</body>
</html>