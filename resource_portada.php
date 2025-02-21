<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Si la sesión está activa, muestra el header correspondiente
if (isset($_SESSION['usuario'])) {
    if ($_SESSION['rol'] === 'admin') {
        include __DIR__ . '/views/header_admin.php';
    } else {
        include __DIR__ . '/views/header_usuario.php';
    }
    
    // Mostrar la página principal con las categorías
    include __DIR__ . '/views/main_content.php';
} else {
    // Si no hay sesión, mostrar el formulario de login
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - ZonaX</title>
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

        .login-form {
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

        input {
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
        <div class="login-form">
            <h1>Iniciar Sesión</h1>
            
            <?php if (isset($error)): ?>
                <div class="error-message">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="post" action="?action=inicio-session">
                <div class="form-group">
                    <label for="email">Correo electrónico:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit">Iniciar Sesión</button>

                <div class="links">
                    <a href="?action=registre">¿No tienes cuenta? Regístrate</a>
                    <br>
                    <a href="?action=recuperar-password">¿Olvidaste tu contraseña?</a>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 ZonaX. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
<?php
}
?>