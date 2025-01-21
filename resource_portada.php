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
        /* ... tus estilos existentes ... */
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