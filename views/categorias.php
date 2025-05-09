<?php
// views/categorias.php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Inicia la sesión solo si no está activa
}

// Configuración de errores
error_reporting(E_ALL);
ini_set('display_errors', 0); // No mostrar errores en pantalla
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../error.log');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías - ZonaX</title>
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
            background-image: url('img/categoria-bg.jpg');
            background-size: cover;
            background-position: center;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.8));
            z-index: 1;
        }

        .page-header-content {
            position: relative;
            z-index: 2;
        }

        .page-title-container {
            display: inline-block;
            position: relative;
            margin-bottom: 1.5rem;
        }

        .page-title {
            font-size: 3rem;
            font-weight: 700;
            color: var(--color-white);
            text-transform: uppercase;
            letter-spacing: 2px;
            position: relative;
            z-index: 2;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .page-title-bg {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 5rem;
            font-weight: 800;
            color: rgba(255,255,255,0.1);
            white-space: nowrap;
            z-index: 1;
            text-transform: uppercase;
        }

        .page-title-decoration {
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 150px;
            height: 4px;
            background: var(--gradient-alt);
            border-radius: 2px;
        }

        .page-description {
            font-size: 1.1rem;
            color: var(--color-gray-200);
            max-width: 700px;
            margin: 1.5rem auto 0;
            line-height: 1.6;
        }

        .categorias-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .categoria-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: var(--transition-fast);
            position: relative;
            height: 300px;
            display: flex;
            flex-direction: column;
        }

        .categoria-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }

        .categoria-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.7) 100%);
            z-index: 1;
        }

        .categoria-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
        }

        .categoria-content {
            position: relative;
            z-index: 2;
            padding: 1.5rem;
            margin-top: auto;
            color: white;
        }

        .categoria-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
        }

        .categoria-description {
            font-size: 0.9rem;
            margin-bottom: 1rem;
            opacity: 0.9;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .categoria-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--color-white);
            color: var(--color-primary);
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: var(--transition-fast);
            text-decoration: none;
        }

        .categoria-btn:hover {
            background: var(--color-primary);
            color: white;
            transform: translateY(-3px);
        }

        .categoria-count {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(255, 255, 255, 0.9);
            color: var(--color-gray-800);
            font-size: 0.8rem;
            font-weight: 600;
            padding: 0.3rem 0.8rem;
            border-radius: 50px;
            z-index: 2;
        }

        .empty-message {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 15px;
            box-shadow: var(--shadow-md);
            margin: 2rem auto;
            max-width: 600px;
        }

        .empty-message i {
            font-size: 3rem;
            color: var(--color-gray-400);
            margin-bottom: 1rem;
        }

        .empty-message h3 {
            font-size: 1.5rem;
            color: var(--color-gray-700);
            margin-bottom: 1rem;
        }

        .empty-message p {
            color: var(--color-gray-600);
            margin-bottom: 1.5rem;
        }

        .empty-message a {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--gradient-main);
            color: white;
            text-decoration: none;
            padding: 0.8rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            transition: var(--transition-fast);
        }

        .empty-message a:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 2.5rem;
            }
            
            .page-title-bg {
                font-size: 4rem;
            }
            
            .categorias-grid {
                grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
                gap: 1.5rem;
            }
            
            .categoria-card {
                height: 250px;
            }
        }

        @media (max-width: 480px) {
            .page-title {
                font-size: 2rem;
            }
            
            .page-title-bg {
                font-size: 3rem;
            }
            
            .categorias-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Animaciones */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .categoria-card {
            animation: fadeIn 0.5s ease-out;
            animation-fill-mode: both;
        }

        .categorias-grid .categoria-card:nth-child(1) { animation-delay: 0.1s; }
        .categorias-grid .categoria-card:nth-child(2) { animation-delay: 0.2s; }
        .categorias-grid .categoria-card:nth-child(3) { animation-delay: 0.3s; }
        .categorias-grid .categoria-card:nth-child(4) { animation-delay: 0.4s; }
        .categorias-grid .categoria-card:nth-child(5) { animation-delay: 0.5s; }
        .categorias-grid .categoria-card:nth-child(6) { animation-delay: 0.6s; }
    </style>
</head>
<body>
    <?php
    if (isset($_SESSION['usuario'])) {
        if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin') {
            include_once __DIR__ . '/header_admin.php';
        } else {
            include_once __DIR__ . '/header_usuario.php';
        }
    } else {
        include_once __DIR__ . '/header_usuario.php';
    }
    ?>

    <div class="container">
        <div class="breadcrumb">
            <a href="?action=portada">Inicio</a>
            <i class="fas fa-chevron-right"></i>
            <span>Categorías</span>
        </div>

        <div class="page-header">
            <div class="page-header-content">
                <div class="page-title-container">
                    <span class="page-title-bg">CATEGORÍAS</span>
                    <h1 class="page-title">Nuestras Categorías</h1>
                    <div class="page-title-decoration"></div>
                </div>
                <p class="page-description">Explora nuestra amplia selección de categorías y encuentra los productos que estás buscando. Tenemos todo lo que necesitas para disfrutar al máximo.</p>
            </div>
        </div>

        <?php if (!empty($categorias)): ?>
            <div class="categorias-grid">
                <?php foreach ($categorias as $categoria): ?>
                    <div class="categoria-card">
                        <?php if (!empty($categoria['imagen'])): ?>
                            <img src="<?= htmlspecialchars($categoria['imagen']); ?>" alt="<?= htmlspecialchars($categoria['nombre_categoria']); ?>" class="categoria-img">
                        <?php else: ?>
                            <img src="img/categoria-default.jpg" alt="<?= htmlspecialchars($categoria['nombre_categoria']); ?>" class="categoria-img">
                        <?php endif; ?>
                        
                        <?php if (isset($categoria['total_productos'])): ?>
                            <div class="categoria-count"><?= $categoria['total_productos']; ?> productos</div>
                        <?php endif; ?>
                        
                        <div class="categoria-content">
                            <h2 class="categoria-title"><?= htmlspecialchars($categoria['nombre_categoria']); ?></h2>
                            <p class="categoria-description"><?= htmlspecialchars($categoria['descripcion'] ?? 'Explora nuestra selección de productos en esta categoría.'); ?></p>
                            <a href="?action=categoria&categoria=<?= $categoria['id']; ?>" class="categoria-btn">
                                Ver productos <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-message">
                <i class="fas fa-folder-open"></i>
                <h3>No hay categorías disponibles</h3>
                <p>Actualmente no hay categorías disponibles. Por favor, vuelve más tarde.</p>
                <a href="?action=portada">
                    <i class="fas fa-home"></i> Volver al inicio
                </a>
            </div>
        <?php endif; ?>
    </div>

    <?php include __DIR__ . '/footer.php'; ?>
</body>
</html>
