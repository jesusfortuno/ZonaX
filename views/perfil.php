<?php
// views/perfil.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Cuenta - ZonaX</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            --gradient-alt: linear-gradient(135deg, #fb923c, #fbbf24);
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --transition-fast: all 0.3s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background-color: var(--color-gray-50);
            color: var(--color-gray-800);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
            font-size: 0.9rem;
            color: var(--color-gray-500);
        }

        .breadcrumb a {
            color: var(--color-gray-600);
            text-decoration: none;
            transition: var(--transition-fast);
        }

        .breadcrumb a:hover {
            color: var(--color-primary);
        }

        .breadcrumb i {
            font-size: 0.7rem;
            color: var(--color-gray-400);
        }

        .page-header {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
            background-color: var(--color-gray-800);
            color: var(--color-white);
            padding: 3rem 1rem;
            border-radius: 15px;
            background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('img/191025.jpg');
            background-size: cover;
            background-position: center;
            position: relative;
            overflow: hidden;
        }

        .page-header-content {
            position: relative;
            z-index: 2;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--color-white);
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .page-description {
            font-size: 1.1rem;
            color: var(--color-gray-200);
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .account-tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
            border-bottom: 1px solid var(--color-gray-200);
            overflow-x: auto;
            padding-bottom: 1px;
        }

        .account-tab {
            padding: 1rem 1.5rem;
            font-weight: 500;
            color: var(--color-gray-600);
            cursor: pointer;
            transition: var(--transition-fast);
            border-bottom: 2px solid transparent;
            white-space: nowrap;
            text-decoration: none;
        }

        .account-tab.active {
            color: var(--color-primary);
            border-bottom: 2px solid var(--color-primary);
        }

        .account-tab:hover:not(.active) {
            color: var(--color-gray-800);
            border-bottom: 2px solid var(--color-gray-300);
        }

        .account-tab i {
            margin-right: 0.5rem;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        .profile-card {
            background: white;
            border-radius: 15px;
            box-shadow: var(--shadow-md);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .profile-card-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--color-gray-200);
        }

        .profile-card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--color-gray-800);
            margin: 0;
        }

        .profile-card-subtitle {
            font-size: 0.9rem;
            color: var(--color-gray-500);
            margin-top: 0.25rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--color-gray-700);
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--color-gray-300);
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition-fast);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px var(--color-primary-light);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        @media (min-width: 768px) {
            .form-row {
                grid-template-columns: 1fr 1fr;
            }
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition-fast);
            border: none;
        }

        .btn-primary {
            background: var(--gradient-main);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--color-gray-300);
            color: var(--color-gray-700);
        }

        .btn-outline:hover {
            background: var(--color-gray-100);
            border-color: var(--color-gray-400);
        }

        .btn i {
            margin-right: 0.5rem;
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background-color: #ecfdf5;
            color: #065f46;
            border-left: 4px solid #10b981;
        }

        .alert-danger {
            background-color: #fef2f2;
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: var(--shadow-md);
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--color-gray-400);
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            color: var(--color-gray-700);
            margin-bottom: 1rem;
        }

        .empty-state p {
            color: var(--color-gray-600);
            margin-bottom: 1.5rem;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="breadcrumb">
            <a href="?action=portada">Inicio</a>
            <i class="fas fa-chevron-right"></i>
            <span>Mi Cuenta</span>
        </div>

        <div class="page-header">
            <div class="page-header-content">
                <h1 class="page-title">MI CUENTA</h1>
                <p class="page-description">Gestiona tu información personal, revisa tus pedidos y actualiza tus preferencias.</p>
            </div>
        </div>

        <div class="account-tabs">
            <a href="?action=perfil&tab=perfil" class="account-tab <?= !isset($_GET['tab']) || $_GET['tab'] === 'perfil' ? 'active' : '' ?>">
                <i class="fas fa-user"></i> Perfil
            </a>
            <a href="?action=perfil&tab=pedidos" class="account-tab <?= isset($_GET['tab']) && $_GET['tab'] === 'pedidos' ? 'active' : '' ?>">
                <i class="fas fa-box"></i> Mis Pedidos
            </a>
            <a href="?action=perfil&tab=direcciones" class="account-tab <?= isset($_GET['tab']) && $_GET['tab'] === 'direcciones' ? 'active' : '' ?>">
                <i class="fas fa-map-marker-alt"></i> Direcciones
            </a>
            <a href="?action=perfil&tab=favoritos" class="account-tab <?= isset($_GET['tab']) && $_GET['tab'] === 'favoritos' ? 'active' : '' ?>">
                <i class="fas fa-heart"></i> Favoritos
            </a>
            <a href="?action=perfil&tab=contrasena" class="account-tab <?= isset($_GET['tab']) && $_GET['tab'] === 'contrasena' ? 'active' : '' ?>">
                <i class="fas fa-lock"></i> Contraseña
            </a>
        </div>

        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?= htmlspecialchars($mensaje) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <?php 
        $tab = $_GET['tab'] ?? 'perfil';
        
        switch ($tab) {
            case 'perfil':
        ?>
            <!-- Perfil Tab -->
            <div class="profile-card">
                <div class="profile-card-header">
                    <div>
                        <h2 class="profile-card-title">Información Personal</h2>
                        <p class="profile-card-subtitle">Actualiza tu información personal</p>
                    </div>
                </div>

                <form action="?action=perfil" method="POST">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="nombre">Nombre</label>
                            <input type="text" id="nombre" name="nombre" class="form-input" value="<?= htmlspecialchars($usuario['nombre'] ?? '') ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-input" value="<?= htmlspecialchars($usuario['email'] ?? '') ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="actualizar_perfil" class="btn btn-primary">
                            <i class="fas fa-save"></i> Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        <?php
            break;
            case 'contrasena':
        ?>
            <!-- Contraseña Tab -->
            <div class="profile-card">
                <div class="profile-card-header">
                    <div>
                        <h2 class="profile-card-title">Cambiar Contraseña</h2>
                        <p class="profile-card-subtitle">Actualiza tu contraseña para mantener tu cuenta segura</p>
                    </div>
                </div>

                <form action="?action=perfil&tab=contrasena" method="POST">
                    <div class="form-group">
                        <label class="form-label" for="current_password">Contraseña Actual</label>
                        <input type="password" id="current_password" name="current_password" class="form-input" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="new_password">Nueva Contraseña</label>
                            <input type="password" id="new_password" name="new_password" class="form-input" required minlength="6">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="confirm_password">Confirmar Contraseña</label>
                            <input type="password" id="confirm_password" name="confirm_password" class="form-input" required minlength="6">
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="cambiar_password" class="btn btn-primary">
                            <i class="fas fa-lock"></i> Actualizar Contraseña
                        </button>
                    </div>
                </form>
            </div>
        <?php
            break;
            case 'pedidos':
        ?>
            <!-- Pedidos Tab -->
            <div class="empty-state">
                <i class="fas fa-box-open"></i>
                <h3>No tienes pedidos recientes</h3>
                <p>Cuando realices un pedido, podrás ver su estado e historial aquí.</p>
                <a href="?action=llistar-productes" class="btn btn-primary">
                    <i class="fas fa-shopping-bag"></i> Ver Productos
                </a>
            </div>
        <?php
            break;
            case 'direcciones':
        ?>
            <!-- Direcciones Tab -->
            <div class="empty-state">
                <i class="fas fa-map-marker-alt"></i>
                <h3>No tienes direcciones guardadas</h3>
                <p>Añade una dirección para agilizar tus compras futuras.</p>
                <button class="btn btn-primary">
                    <i class="fas fa-plus"></i> Añadir Dirección
                </button>
            </div>
        <?php
            break;
            case 'favoritos':
        ?>
            <!-- Favoritos Tab -->
            <div class="empty-state">
                <i class="fas fa-heart"></i>
                <h3>No tienes productos favoritos</h3>
                <p>Marca productos como favoritos para encontrarlos fácilmente más tarde.</p>
                <a href="?action=llistar-productes" class="btn btn-primary">
                    <i class="fas fa-shopping-bag"></i> Ver Productos
                </a>
            </div>
        <?php
            break;
        }
        ?>
    </div>

    <script>
        // Validación de formulario de contraseña
        document.addEventListener('DOMContentLoaded', function() {
            const passwordForm = document.querySelector('form[name="cambiar_password"]');
            if (passwordForm) {
                passwordForm.addEventListener('submit', function(e) {
                    const newPassword = document.getElementById('new_password').value;
                    const confirmPassword = document.getElementById('confirm_password').value;
                    
                    if (newPassword !== confirmPassword) {
                        e.preventDefault();
                        alert('Las contraseñas nuevas no coinciden');
                    }
                });
            }
        });
    </script>
</body>
</html>
