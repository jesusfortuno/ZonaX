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
        :root {
            --color-primary: #ff6b6b;
            --color-primary-light: #fca5a5;
            --color-primary-dark: #ef4444;
            --color-secondary: #fb923c;
            --color-secondary-light: #fdba74;
            --color-accent: #fbbf24;
            --color-white: #ffffff;
            --color-gray-50: #f9fafb;
            --color-gray-100: #f3f4f6;
            --color-gray-200: #e5e7eb;
            --color-gray-300: #d1d5db;
            --color-gray-400: #9ca3af;
            --color-gray-500: #6b7280;
            --color-gray-600: #4b5563;
            --color-gray-700: #374151;
            --color-gray-800: #1f2937;
            --color-gray-900: #111827;
            --gradient-main: linear-gradient(90deg, #ff6b6b, #ffa36b);
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.05);
            --border-radius-sm: 0.375rem;
            --border-radius-md: 0.5rem;
            --border-radius-lg: 0.75rem;
            --border-radius-xl: 1rem;
            --transition-fast: all 0.3s ease;
        }

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

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex: 1;
            padding: 2rem;
        }

        .login-wrapper {
            display: flex;
            width: 100%;
            max-width: 1000px;
            background-color: var(--color-white);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
        }

        .login-image {
            flex: 1;
            background-image: url('https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-I6w406GYD47n6QJEY1xpTgP4r3qGw1.png');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: var(--color-white);
            padding: 2rem;
            text-align: center;
        }

        .login-image h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.8), 0 0 5px rgba(0, 0, 0, 0.5);
        }

        .login-image p {
            font-size: 1.1rem;
            max-width: 400px;
            margin-bottom: 2rem;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.8), 0 0 5px rgba(0, 0, 0, 0.5);
        }

        .login-form-container {
            flex: 1;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-logo {
            text-align: center;
            margin-bottom: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-logo img {
            height: 50px;
            width: auto;
        }

        .login-title {
            text-align: center;
            margin-bottom: 2rem;
            color: var(--color-gray-800);
            font-weight: 600;
            font-size: 1.8rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--color-gray-700);
            font-weight: 500;
            font-size: 0.95rem;
        }

        .form-input {
            width: 100%;
            padding: 0.9rem 1rem 0.9rem 2.8rem;
            border: 1px solid var(--color-gray-200);
            border-radius: var(--border-radius-md);
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: var(--color-gray-50);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.1);
            background-color: var(--color-white);
        }

        .form-icon {
            position: absolute;
            left: 1rem;
            top: 2.4rem;
            color: var(--color-primary);
        }

        .form-button {
            width: 100%;
            padding: 1rem;
            background: var(--gradient-main);
            color: var(--color-white);
            border: none;
            border-radius: var(--border-radius-md);
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(255, 107, 107, 0.2);
        }

        .form-button:hover {
            background: linear-gradient(90deg, #ff5c5c, #ff9559);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(255, 107, 107, 0.3);
        }

        .form-links {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--color-gray-200);
        }

        .form-links a {
            color: var(--color-primary);
            text-decoration: none;
            font-size: 0.95rem;
            transition: color 0.3s;
            display: inline-block;
            margin-bottom: 0.75rem;
        }

        .form-links a:hover {
            color: var(--color-primary-dark);
        }

        .error-message {
            color: var(--color-primary-dark);
            text-align: center;
            margin-bottom: 1.5rem;
            background-color: rgba(239, 68, 68, 0.1);
            padding: 0.8rem;
            border-radius: var(--border-radius-md);
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .footer {
            background: var(--gradient-main);
            color: var(--color-white);
            padding: 1.2rem;
            text-align: center;
            font-size: 0.9rem;
        }

        @media (max-width: 992px) {
            .login-wrapper {
                flex-direction: column;
                max-width: 500px;
            }
            
            .login-image {
                display: none;
            }
        }

        @media (max-width: 576px) {
            .login-form-container {
                padding: 2rem 1.5rem;
            }
            
            .login-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-wrapper">
            <div class="login-image">
                <h2>Bienvenido a ZonaX</h2>
                <p>Tu destino para productos de calidad con los mejores precios y envío rápido.</p>
            </div>
            
            <div class="login-form-container">
                <div class="login-logo">
                    <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/logo-RaV2p76V4QKsrXp7YmPWRwXhAJZsqH.png" alt="Logo Zona">
                </div>
                
                <h1 class="login-title">Iniciar Sesión</h1>
                
                <?php if (isset($error)): ?>
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="?action=inicio-session">
                    <div class="form-group">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <i class="fas fa-envelope form-icon"></i>
                        <input type="email" id="email" name="email" class="form-input" placeholder="Ingresa tu correo" required>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Contraseña</label>
                        <i class="fas fa-lock form-icon"></i>
                        <input type="password" id="password" name="password" class="form-input" placeholder="Ingresa tu contraseña" required>
                    </div>

                    <button type="submit" class="form-button">Iniciar Sesión</button>

                    <div class="form-links">
                        <a href="?action=registre">¿No tienes cuenta? Regístrate</a>
                        <br>
                        <a href="?action=recuperar-password">¿Olvidaste tu contraseña?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php
}
?>
