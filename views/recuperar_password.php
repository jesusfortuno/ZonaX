<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña - ZonaX</title>
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
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex: 1;
            padding: 2rem;
        }

        .recovery-form {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            text-align: center;
            margin-bottom: 2rem;
            color: #333;
        }

        .form-group {
            margin-bottom: 1.5rem;
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

        .links {
            text-align: center;
            margin-top: 1rem;
        }

        .links a {
            color: #333;
            text-decoration: none;
        }

        .links a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 1rem;
        }

        .success-message {
            color: green;
            text-align: center;
            margin-bottom: 1rem;
        }

        footer {
            background-color: #333;
            color: white;
            padding: 1rem;
            text-align: center;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="recovery-form">
            <h1>Recuperar Contraseña</h1>

            <?php if ($success): ?>
                <div class="success-message">
                    <p>Tu contraseña ha sido actualizada correctamente.</p>
                    <p>Puedes <a href="?action=login">iniciar sesión</a> con tu nueva contraseña.</p>
                </div>
            <?php else: ?>
                <?php if (isset($errors['general'])): ?>
                    <div class="error-message">
                        <?= htmlspecialchars($errors['general']) ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="?action=recuperar-password">
                    <div class="form-group">
                        <label for="email">Correo electrónico:</label>
                        <input type="email" id="email" name="email" required>
                        <?php if (isset($errors['email'])): ?>
                            <span class="error-message"><?= htmlspecialchars($errors['email']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="respuesta_seguridad">Respuesta de seguridad:</label>
                        <input type="text" id="respuesta_seguridad" name="respuesta_seguridad" required>
                        <?php if (isset($errors['respuesta_seguridad'])): ?>
                            <span class="error-message"><?= htmlspecialchars($errors['respuesta_seguridad']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="nueva_contraseña">Nueva contraseña:</label>
                        <input type="password" id="nueva_contraseña" name="nueva_contraseña" required>
                        <?php if (isset($errors['nueva_contraseña'])): ?>
                            <span class="error-message"><?= htmlspecialchars($errors['nueva_contraseña']) ?></span>
                        <?php endif; ?>
                    </div>

                    <button type="submit">Restablecer Contraseña</button>
                </form>

                <div class="links">
                    <a href="?action=login">Volver al inicio de sesión</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include __DIR__ . '/footer.php'; ?>
</body>
</html>
