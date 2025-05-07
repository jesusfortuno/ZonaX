<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - TDIW</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f5f5f5;
            padding: 2rem;
            align-items: center;
        }

        h1 {
            text-align: center;
            margin-bottom: 2rem;
            color: #333;
        }

        form {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
        }

        input, select {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        button {
            width: 100%;
            padding: 1rem;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            margin-bottom: 1rem;
        }

        button:hover {
            background-color: #444;
        }

        .error-message {
            color: red;
            margin-bottom: 1rem;
        }

        p {
            text-align: center;
        }

        a {
            color: #333;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
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
        <span class="error-message"><?= $errors['nombre'] ?? '' ?></span>

        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required>
        <span id="email-error" class="error-message"><?= $errors['email'] ?? '' ?></span>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <span class="error-message"><?= $errors['password'] ?? '' ?></span>

        <label for="pregunta_seguridad">Pregunta de seguridad:</label>
        <select name="pregunta_seguridad" id="pregunta_seguridad" required>
            <option value="">Seleccione una pregunta</option>
            <option value="mascota">¿Cuál fue el nombre de tu primera mascota?</option>
            <option value="ciudad">¿En qué ciudad naciste?</option>
            <option value="escuela">¿Cuál fue tu primera escuela?</option>
        </select>

        <label for="respuesta_seguridad">Respuesta:</label>
        <input type="text" id="respuesta_seguridad" name="respuesta_seguridad" required>

        <button type="submit">Registrar</button>

        <?php if (isset($errors['general'])): ?>
            <p class="error-message"><?= $errors['general']; ?></p>
        <?php endif; ?>
    </form>

    <p>¿Ya tienes cuenta? <a href="?action=login">Iniciar sesión</a></p>
    <p>¿Olvidaste tu contraseña? <a href="?action=recuperar-password">Recuperar contraseña</a></p>
    <?php include __DIR__ . '/footer.php'; ?>
</body>
</html>
