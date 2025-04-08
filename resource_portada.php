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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            background: linear-gradient(135deg, #fff5f7 0%, #fff9f0 100%);
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
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            width: 100%;
            max-width: 420px;
            position: relative;
            overflow: hidden;
        }

        .login-form::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #ff6b6b, #ffa36b, #ffd56b);
        }

        .logo {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .logo h2 {
            color: #333;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .logo span {
            color: #ff6b6b;
        }

        h1 {
            text-align: center;
            margin-bottom: 2rem;
            color: #333;
            font-weight: 600;
            font-size: 1.8rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-weight: 500;
            font-size: 0.9rem;
        }

        input {
            width: 100%;
            padding: 0.9rem 1rem 0.9rem 2.8rem;
            border: 1px solid #f0f0f0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: #fffcf9;
        }

        input:focus {
            outline: none;
            border-color: #ffa36b;
            box-shadow: 0 0 0 3px rgba(255, 163, 107, 0.1);
            background-color: #fff;
        }

        .form-icon {
            position: absolute;
            left: 1rem;
            top: 2.4rem;
            color: #ffa36b;
        }

        button {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(90deg, #ff6b6b, #ffa36b);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(255, 107, 107, 0.2);
        }

        button:hover {
            background: linear-gradient(90deg, #ff5c5c, #ff9559);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(255, 107, 107, 0.3);
        }

        .links {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #f0f0f0;
        }

        .links a {
            color: #ff6b6b;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        .links a:hover {
            color: #ffa36b;
        }

        .links a:first-child {
            margin-bottom: 0.5rem;
            display: inline-block;
        }

        .error-message {
            color: #e74c3c;
            text-align: center;
            margin-bottom: 1.5rem;
            background-color: rgba(231, 76, 60, 0.1);
            padding: 0.8rem;
            border-radius: 8px;
            font-size: 0.9rem;
        }

        footer {
            background-color: #ff6b6b;
            color: white;
            padding: 1.2rem;
            text-align: center;
            margin-top: auto;
            font-size: 0.9rem;
        }

        @media (max-width: 480px) {
            .login-form {
                padding: 2rem 1.5rem;
            }
            
            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-form">
            <div class="logo">
                <h2>Zona<span>X</span></h2>
            </div>
            <h1>Iniciar Sesión</h1>
            
            <?php if (isset($error)): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="post" action="?action=inicio-session">
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <i class="fas fa-envelope form-icon"></i>
                    <input type="email" id="email" name="email" placeholder="Ingresa tu correo" required>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <i class="fas fa-lock form-icon"></i>
                    <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>
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
