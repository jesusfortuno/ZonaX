<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - ZonaX</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background-color: #fff9f5;
        }
        
        .header-container {
            background: linear-gradient(90deg, #ff6b6b, #ffa36b);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        nav {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1.2rem 2rem;
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
            font-size: 1.8rem;
            color: white;
            text-decoration: none;
        }
        
        .logo span {
            color: #ffd56b;
            margin-left: 5px;
        }
        
        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
        }
        
        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: white;
            transition: all 0.3s ease;
        }
        
        .nav-item:hover {
            transform: translateY(-3px);
        }
        
        .nav-item i {
            font-size: 1.2rem;
            margin-bottom: 0.3rem;
        }
        
        .nav-item span {
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .admin-text {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: white;
            position: relative;
        }
        
        .admin-text i {
            font-size: 1.2rem;
            margin-bottom: 0.3rem;
            color: #ffd56b;
        }
        
        .admin-text span {
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .admin-badge {
            position: absolute;
            top: -5px;
            right: -15px;
            background-color: #ffd56b;
            color: #333;
            font-size: 0.65rem;
            font-weight: 600;
            padding: 0.1rem 0.4rem;
            border-radius: 4px;
            text-transform: uppercase;
        }
        
        .right-links {
            display: flex;
            gap: 2rem;
        }
        
        @media (max-width: 768px) {
            nav {
                flex-wrap: wrap;
                justify-content: center;
                gap: 1rem;
                padding: 1rem;
            }
            
            .logo-container {
                width: 100%;
                justify-content: center;
                margin-bottom: 1rem;
            }
            
            .nav-links {
                width: 100%;
                justify-content: space-around;
                margin-bottom: 1rem;
                gap: 0.5rem;
            }
            
            .right-links {
                width: 100%;
                justify-content: space-around;
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
                <a href="?action=carrito" class="nav-item">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Carrito</span>
                </a>
                
                <a href="?action=salir" class="nav-item">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Cerrar Sesión</span>
                </a>
            </div>
        </nav>
    </div>
