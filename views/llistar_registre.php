<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - TDIW</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#email').blur(function() {
            var email = $(this).val();
            $.ajax({
                url: '?action=verificar-email',
                method: 'POST',
                data: { email: email },
                success: function(response) {
                    if(response.exists) {
                        $('#email-error').text('Este email ya está registrado');
                    } else {
                        $('#email-error').text('');
                    }
                }
            });
        });
    });
    </script>
</head>
<body>
    <h1>Registro de Usuario</h1>
    
    <form method="post" action="?action=registre-session">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <span style="color: red;"><?= $errors['nombre'] ?? '' ?></span>
        <br>

        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required>
        <span id="email-error" style="color: red;"><?= $errors['email'] ?? '' ?></span>
        <br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <span style="color: red;"><?= $errors['password'] ?? '' ?></span>
        <br>

        <label for="pregunta_seguridad">Pregunta de seguridad:</label>
        <select name="pregunta_seguridad" id="pregunta_seguridad" required>
            <option value="">Seleccione una pregunta</option>
            <option value="mascota">¿Cuál fue el nombre de tu primera mascota?</option>
            <option value="ciudad">¿En qué ciudad naciste?</option>
            <option value="escuela">¿Cuál fue tu primera escuela?</option>
        </select>
        <br>

        <label for="respuesta_seguridad">Respuesta:</label>
        <input type="text" id="respuesta_seguridad" name="respuesta_seguridad" required>
        <br>

        <button type="submit">Registrar</button>
        <?php if (isset($errors['general'])): ?>
            <p style="color: red;"><?= $errors['general']; ?></p>
        <?php endif; ?>
    </form>

    <p>¿Ya tienes cuenta? <a href="?action=login">Iniciar sesión</a></p>
    <p>¿Olvidaste tu contraseña? <a href="?action=recuperar-password">Recuperar contraseña</a></p>
</body>
</html>