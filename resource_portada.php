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
    HEAD
        /* ... tus estilos existentes ... */
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
        }

        /* Estilos de navegación */
        nav {
            background-color: #333;
            padding: 1rem;
            HEAD
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between; /* Alinea elementos a los extremos */
            align-items: center;
        }
        nav .links {
            display: flex;
            gap: 1rem; /* Espacio entre los enlaces */
        }
        nav a {
            color: white;
            text-decoration: none;
            margin-right: 1rem;
            font-weight: 400;
        }
        nav .usuario {
            color: white;
            font-weight: 600;
        }
        nav span {
            color: #ffcc00;
            margin-left: 1rem;
            font-weight: 600;
        }

        /* Estilos para los títulos de las secciones */
        section h2 {
            font-weight: 600;
            letter-spacing: 1px;
            font-size: 1.2rem;
        }

        /* Contenedor para las secciones */
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 1.9rem;
            justify-content: center;
            padding: 0 1.9rem;
            margin-bottom: 1rem;
            flex: 1;
            margin-top: 4rem;
        }

        /* Mantiene el formato de rectángulos */
        section {
            background-color: #f5f5f5;
            padding: 1.35rem;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            width: 445px;
            min-height: 235px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 1.25rem;
        }

        section:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
        }

        /* Estilo para las imágenes dentro de las secciones */
        section img {
            max-width: 185px;
            height: auto;
            border-radius: 8px;
        }

        /* Footer ajustado */
        footer {
            background-color: #333;
            color: white;
            padding: 0.8rem;
            text-align: center;
            width: 100%;
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