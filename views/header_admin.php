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
            --color-primary: #f87171;
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
            --transition-fast: all 0.2s ease;
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
            background: linear-gradient(90deg, #ff6b6b, #ffa36b);
            box-shadow: var(--shadow-md);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        nav {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0.75rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
        }
        
        .logo {
            font-weight: 600;
            font-size: 1.5rem;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        
        .logo span {
            color: var(--color-accent);
            margin-left: 2px;
        }
        
        .nav-links {
            display: flex;
            align-items: center;
            gap: 1.25rem;
        }
        
        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: white;
            transition: var(--transition-fast);
            padding: 0.25rem;
        }
        
        .nav-item:hover {
            transform: translateY(-2px);
        }
        
        .nav-item i {
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }
        
        .nav-item span {
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .admin-text {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: white;
            position: relative;
            padding: 0.25rem;
        }
        
        .admin-text i {
            font-size: 1rem;
            margin-bottom: 0.25rem;
            color: var(--color-accent);
        }
        
        .admin-text span {
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .admin-badge {
            position: absolute;
            top: -5px;
            right: -12px;
            background-color: var(--color-accent);
            color: var(--color-gray-800);
            font-size: 0.6rem;
            font-weight: 600;
            padding: 0.1rem 0.3rem;
            border-radius: 3px;
            text-transform: uppercase;
        }
        
        .right-links {
            display: flex;
            gap: 1.25rem;
        }
        
        .carrito-nav-item {
            position: relative;
        }
        
        .carrito-count {
            position: absolute;
            top: -5px;
            right: -8px;
            background-color: var(--color-accent);
            color: var(--color-gray-800);
            font-size: 0.65rem;
            font-weight: 600;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        @media (max-width: 992px) {
            nav {
                padding: 0.75rem 1rem;
            }
            
            .nav-links {
                gap: 0.75rem;
            }
        }
        
        @media (max-width: 768px) {
            nav {
                flex-wrap: wrap;
                justify-content: center;
                gap: 0.75rem;
            }
            
            .logo-container {
                width: 100%;
                justify-content: center;
                margin-bottom: 0.5rem;
            }
            
            .nav-links {
                width: 100%;
                justify-content: space-around;
                margin-bottom: 0.5rem;
                gap: 0.5rem;
                flex-wrap: wrap;
            }
            
            .right-links {
                width: 100%;
                justify-content: space-around;
            }
            
            .nav-item, .admin-text {
                padding: 0.25rem;
            }
            
            .nav-item span, .admin-text span {
                font-size: 0.7rem;
            }
        }
    </style>
</head>
<body>
    <div class="header-container">
        <nav>
            <div class="logo-container">
                <a href="?action=portada" class="logo">Zona<span>X</span></a>
            </div>
            
            <div class="nav-links">
                <a href="?action=portada" class="nav-item">
                    <i class="fas fa-home"></i>
                    <span>Portada</span>
                </a>
                
                <?php if (isset($_SESSION['usuario'])): ?>
                    <div class="admin-text">
                        <i class="fas fa-user-shield"></i>
                        <span><?= htmlspecialchars($_SESSION['usuario']); ?></span>
                        <div class="admin-badge">Admin</div>
                    </div>
                <?php endif; ?>
                
                <a href="?action=dashboard" class="nav-item">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="?action=gestionar-productos" class="nav-item">
                    <i class="fas fa-box"></i>
                    <span>Gestionar Productos</span>
                </a>
                
                <a href="?action=portada" class="nav-item">
                    <i class="fas fa-tags"></i>
                    <span>Categorías</span>
                </a>
            </div>
            
            <div class="right-links">
                <a href="?action=carrito" class="nav-item carrito-nav-item">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Carrito</span>
                    <?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0): ?>
                        <div class="carrito-count"><?= count($_SESSION['carrito']); ?></div>
                    <?php endif; ?>
                </a>
                
                <a href="?action=salir" class="nav-item">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Cerrar Sesión</span>
                </a>
            </div>
        </nav>
    </div>
