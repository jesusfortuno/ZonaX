<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - TDIW</title>
</head>
<body>
    <h1>Bienvenido a la página de registro</h1>
    
    <form method="post" action="?action=registre-session">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <span style="color: red;"><?= $errors['nombre'] ?? '' ?></span>
        <br>

        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required>
        <span style="color: red;"><?= $errors['email'] ?? '' ?></span>
        <br>

        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña" required>
        <span style="color: red;"><?= $errors['contraseña'] ?? '' ?></span>
        <br>

        <button type="submit">Registrar</button>
        <?php if (isset($errors['general'])): ?>
            <p style="color: red;"><?= $errors['general']; ?></p>
        <?php endif; ?>
    </form>

</body>
</html>