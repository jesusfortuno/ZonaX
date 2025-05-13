<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - ZonaX</title>
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
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.05);
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
        }
        
        .header-container {
            background: var(--gradient-main);
            box-shadow: var(--shadow-md);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .top-bar {
            background-color: rgba(0, 0, 0, 0.1);
            padding: 0.5rem 0;
            color: var(--color-white);
            font-size: 0.85rem;
        }
        
        .top-bar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }
        
        .top-bar-left {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        
        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        
        .admin-badge {
            background-color: var(--color-accent);
            color: var(--color-gray-800);
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        nav {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
        }
        
        .logo {
            font-weight: 700;
            font-size: 1.75rem;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            letter-spacing: 1px;
        }
        
        .logo span {
            color: var(--color-accent);
            margin-left: 2px;
        }
        
        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
        }
        
        .nav-item {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition-fast);
            position: relative;
            padding: 0.5rem 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .nav-item::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--color-white);
            transition: var(--transition-fast);
        }
        
        .nav-item:hover::after {
            width: 100%;
        }
        
        .nav-item:hover {
            color: var(--color-accent);
        }
        
        .admin-text {
            display: flex;
            align-items: center;
            color: white;
            gap: 0.5rem;
            font-weight: 500;
            position: relative;
        }
        
        .admin-text i {
            color: var(--color-accent);
        }
        
        .admin-badge-small {
            position: absolute;
            top: -8px;
            right: -15px;
            background-color: var(--color-accent);
            color: var(--color-gray-800);
            font-size: 0.6rem;
            font-weight: 600;
            padding: 0.1rem 0.4rem;
            border-radius: 3px;
            text-transform: uppercase;
        }
        
        .right-links {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        
        .icon-link {
            color: white;
            text-decoration: none;
            font-size: 1.25rem;
            transition: var(--transition-fast);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .icon-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
        }
        
        .carrito-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--color-accent);
            color: var(--color-gray-800);
            font-size: 0.7rem;
            font-weight: 600;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }
        
        @media (max-width: 992px) {
            .nav-links {
                gap: 1.5rem;
            }
            
            .top-bar-left, .top-bar-right {
                gap: 1rem;
            }
        }
        
        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }
            
            .nav-links {
                position: fixed;
                top: 0;
                left: -100%;
                width: 80%;
                max-width: 300px;
                height: 100vh;
                background: var(--color-gray-800);
                flex-direction: column;
                align-items: flex-start;
                padding: 5rem 2rem 2rem;
                gap: 1.5rem;
                transition: left 0.3s ease;
                z-index: 1001;
                overflow-y: auto;
            }
            
            .nav-links.active {
                left: 0;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            }
            
            .nav-item {
                width: 100%;
                padding: 0.75rem 0;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }
            
            .nav-item::after {
                display: none;
            }
            
            .close-menu {
                position: absolute;
                top: 1rem;
                right: 1rem;
                background: none;
                border: none;
                color: white;
                font-size: 1.5rem;
                cursor: pointer;
            }
            
            .top-bar {
                display: none;
            }
        }
        
        @media (max-width: 576px) {
            .logo {
                font-size: 1.5rem;
            }
            
            .right-links {
                gap: 1rem;
            }
            
            .icon-link {
                width: 36px;
                height: 36px;
                font-size: 1.1rem;
            }
        }
        
        /* Overlay for mobile menu */
        .menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            display: none;
        }
        
        .menu-overlay.active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="header-container">
        <div class="top-bar">
            <div class="top-bar-content">
                <div class="top-bar-left">
                    <span><i class="fas fa-user-shield"></i> Panel de Administración</span>
                    <span class="admin-badge">Administrador</span>
                </div>
                <div class="top-bar-right">
                    <a href="?action=dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    <a href="?action=portada"><i class="fas fa-store"></i> Ver Tienda</a>
                </div>
            </div>
        </div>
        
        <nav>
            <div class="logo-container">
                <a href="?action=dashboard" class="logo">Zona<span>X</span></a>
            </div>
            
            <button class="mobile-menu-btn" id="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="nav-links" id="nav-links">
                <button class="close-menu" id="close-menu">
                    <i class="fas fa-times"></i>
                </button>
                
                <a href="?action=dashboard" class="nav-item">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                
                <?php if (isset($_SESSION['usuario'])): ?>
                    <span class="admin-text">
                        <i class="fas fa-user-shield"></i>
                        <?= htmlspecialchars($_SESSION['usuario']); ?>
                        <div class="admin-badge-small">Admin</div>
                    </span>
                <?php endif; ?>
                
                <a href="?action=gestionar-productos" class="nav-item">
                    <i class="fas fa-box"></i> Productos
                </a>
                
                <a href="?action=gestionar-usuarios" class="nav-item">
                    <i class="fas fa-users"></i> Usuarios
                </a>
                
                <a href="?action=portada" class="nav-item">
                    <i class="fas fa-tags"></i> Categorías
                </a>
                
                <a href="?action=gestionar-pedidos" class="nav-item">
                    <i class="fas fa-shopping-bag"></i> Pedidos
                </a>
            </div>
            
            <div class="right-links">
                <a href="?action=notificaciones" class="icon-link" title="Notificaciones">
                    <i class="fas fa-bell"></i>
                </a>
                
                <a href="?action=carrito" class="icon-link" title="Carrito">
                    <i class="fas fa-shopping-cart"></i>
                    <?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0): ?>
                        <div class="carrito-count"><?= count($_SESSION['carrito']); ?></div>
                    <?php endif; ?>
                </a>
                
                <a href="?action=salir" class="icon-link" title="Cerrar Sesión">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </nav>
    </div>
    
    <div class="menu-overlay" id="menu-overlay"></div>
    
    <script>
        // Mobile menu functionality
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const closeMenuBtn = document.getElementById('close-menu');
            const navLinks = document.getElementById('nav-links');
            const menuOverlay = document.getElementById('menu-overlay');
            
            mobileMenuBtn.addEventListener('click', function() {
                navLinks.classList.add('active');
                menuOverlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
            
            closeMenuBtn.addEventListener('click', function() {
                navLinks.classList.remove('active');
                menuOverlay.classList.remove('active');
                document.body.style.overflow = '';
            });
            
            menuOverlay.addEventListener('click', function() {
                navLinks.classList.remove('active');
                menuOverlay.classList.remove('active');
                document.body.style.overflow = '';
            });
        });
    </script>
</body>
</html>
