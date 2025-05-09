<?php
// views/llistar_productes.php
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
    <title>Nuestros Productos - ZonaX</title>
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
            background-color: var(--color-gray-900);
            color: var(--color-white);
            padding: 3rem 1rem;
            border-radius: 15px;
            background-image: url('img/productos-bg.jpg');
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

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--color-white);
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .page-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: var(--gradient-main);
            border-radius: 2px;
        }

        .page-description {
            font-size: 1.1rem;
            color: var(--color-gray-200);
            max-width: 700px;
            margin: 1.5rem auto 0;
            line-height: 1.6;
        }

        .products-container {
            display: flex;
            gap: 2rem;
        }

        .filters-sidebar {
            width: 280px;
            flex-shrink: 0;
        }

        .filter-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow-md);
        }

        .filter-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--color-gray-800);
            padding-bottom: 0.5rem;
            border-bottom: 1px solid var(--color-gray-200);
        }

        .filter-group {
            margin-bottom: 1.2rem;
        }

        .filter-label {
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--color-gray-700);
            display: block;
        }

        .filter-select {
            width: 100%;
            padding: 0.6rem 1rem;
            border: 1px solid var(--color-gray-300);
            border-radius: 8px;
            font-size: 0.9rem;
            color: var(--color-gray-700);
            background-color: var(--color-gray-50);
            transition: var(--transition-fast);
        }

        .filter-select:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 2px rgba(255, 107, 107, 0.2);
        }

        .search-group {
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 0.6rem 1rem 0.6rem 2.5rem;
            border: 1px solid var(--color-gray-300);
            border-radius: 8px;
            font-size: 0.9rem;
            color: var(--color-gray-700);
            background-color: var(--color-gray-50);
            transition: var(--transition-fast);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 2px rgba(255, 107, 107, 0.2);
        }

        .search-icon {
            position: absolute;
            left: 0.8rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--color-gray-500);
            font-size: 0.9rem;
        }

        .price-range {
            margin-top: 1rem;
        }

        .price-inputs {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            margin-top: 0.5rem;
        }

        .price-input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid var(--color-gray-300);
            border-radius: 6px;
            font-size: 0.85rem;
        }

        .price-separator {
            color: var(--color-gray-500);
        }

        .filter-checkbox-group {
            margin-top: 0.5rem;
        }

        .filter-checkbox-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .filter-checkbox {
            margin-right: 0.5rem;
        }

        .filter-checkbox-label {
            font-size: 0.9rem;
            color: var(--color-gray-700);
        }

        .filter-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .filter-btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition-fast);
        }

        .filter-btn-apply {
            background: var(--gradient-main);
            color: white;
            flex: 2;
        }

        .filter-btn-apply:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        .filter-btn-reset {
            background: var(--color-gray-200);
            color: var(--color-gray-700);
            flex: 1;
        }

        .filter-btn-reset:hover {
            background: var(--color-gray-300);
        }

        .products-grid-container {
            flex: 1;
        }

        .products-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .products-count {
            font-size: 0.95rem;
            color: var(--color-gray-600);
        }

        .products-sort {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sort-label {
            font-size: 0.9rem;
            color: var(--color-gray-600);
        }

        .sort-select {
            padding: 0.4rem 0.8rem;
            border: 1px solid var(--color-gray-300);
            border-radius: 6px;
            font-size: 0.9rem;
            color: var(--color-gray-700);
            background-color: var(--color-white);
        }

        .productos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
        }

        .producto-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: var(--transition-fast);
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .producto-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }

        .producto-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: var(--color-primary);
            color: white;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 0.3rem 0.8rem;
            border-radius: 50px;
            z-index: 2;
        }

        .producto-badge.new {
            background: var(--color-primary);
        }

        .producto-badge.sale {
            background: var(--color-secondary);
        }

        .producto-badge.hot {
            background: #e11d48;
        }

        .producto-img-container {
            position: relative;
            overflow: hidden;
            height: 220px;
        }

        .producto-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .producto-card:hover .producto-img {
            transform: scale(1.05);
        }

        .producto-actions {
            position: absolute;
            top: 1rem;
            right: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            opacity: 0;
            transform: translateX(10px);
            transition: all 0.3s ease;
        }

        .producto-card:hover .producto-actions {
            opacity: 1;
            transform: translateX(0);
        }

        .producto-action-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: white;
            color: var(--color-gray-700);
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            transition: var(--transition-fast);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .producto-action-btn:hover {
            background: var(--color-primary);
            color: white;
            transform: translateY(-3px);
        }

        .producto-content {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .producto-category {
            font-size: 0.8rem;
            color: var(--color-gray-500);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .producto-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--color-gray-800);
            margin-bottom: 0.5rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .producto-title a {
            color: inherit;
            text-decoration: none;
            transition: var(--transition-fast);
        }

        .producto-title a:hover {
            color: var(--color-primary);
        }

        .producto-description {
            font-size: 0.9rem;
            color: var(--color-gray-600);
            margin-bottom: 1rem;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex-grow: 1;
        }

        .producto-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
        }

        .producto-price {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--color-primary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .producto-price-old {
            font-size: 0.9rem;
            color: var(--color-gray-500);
            text-decoration: line-through;
        }

        .producto-rating {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            color: var(--color-accent);
            font-size: 0.9rem;
        }

        .producto-rating-count {
            color: var(--color-gray-500);
            font-size: 0.8rem;
        }

        .producto-btn {
            margin-top: 1rem;
            width: 100%;
            padding: 0.8rem;
            border: none;
            border-radius: 8px;
            background: var(--gradient-main);
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition-fast);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .producto-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 3rem;
            gap: 0.5rem;
        }

        .pagination-item {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: white;
            color: var(--color-gray-700);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition-fast);
            box-shadow: var(--shadow-sm);
        }

        .pagination-item:hover, .pagination-item.active {
            background: var(--color-primary);
            color: white;
        }

        .pagination-item.disabled {
            opacity: 0.5;
            cursor: not-allowed;
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

        @media (max-width: 992px) {
            .products-container {
                flex-direction: column;
            }
            
            .filters-sidebar {
                width: 100%;
                margin-bottom: 2rem;
            }
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
            }
            
            .productos-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .page-title {
                font-size: 1.8rem;
            }
            
            .productos-grid {
                grid-template-columns: 1fr;
            }
            
            .products-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }

        /* Animaciones */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .producto-card {
            animation: fadeIn 0.5s ease-out;
            animation-fill-mode: both;
        }

        .productos-grid .producto-card:nth-child(1) { animation-delay: 0.1s; }
        .productos-grid .producto-card:nth-child(2) { animation-delay: 0.2s; }
        .productos-grid .producto-card:nth-child(3) { animation-delay: 0.3s; }
        .productos-grid .producto-card:nth-child(4) { animation-delay: 0.4s; }
        .productos-grid .producto-card:nth-child(5) { animation-delay: 0.5s; }
        .productos-grid .producto-card:nth-child(6) { animation-delay: 0.6s; }
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
            <span>Productos</span>
        </div>

        <div class="page-header">
            <div class="page-header-content">
                <h1 class="page-title">Nuestros Productos</h1>
                <p class="page-description">Descubre nuestra amplia selección de productos de alta calidad. Encuentra lo que necesitas para disfrutar al máximo.</p>
            </div>
        </div>

        <div class="products-container">
            <!-- Sidebar de filtros (ahora a la izquierda) -->
            <div class="filters-sidebar">
                <div class="filter-card">
                    <h3 class="filter-title">Filtros</h3>
                    
                    <div class="filter-group">
                        <label for="category-filter" class="filter-label">Categoría</label>
                        <select id="category-filter" class="filter-select">
                            <option value="">Todas las categorías</option>
                            <option value="1">Vibradores Mujer</option>
                            <option value="2">Vibradores Hombre</option>
                            <option value="3">Juguetes para Parejas</option>
                            <option value="4">Lubricantes</option>
                            <option value="6">Lencería</option>
                            <option value="7">BDSM</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="price-range" class="filter-label">Rango de precio</label>
                        <div class="price-range">
                            <div class="price-inputs">
                                <input type="number" id="price-min" class="price-input" placeholder="Min" min="0">
                                <span class="price-separator">-</span>
                                <input type="number" id="price-max" class="price-input" placeholder="Max" min="0">
                            </div>
                        </div>
                    </div>
                    
                    <div class="filter-group">
                        <label class="filter-label">Disponibilidad</label>
                        <div class="filter-checkbox-group">
                            <div class="filter-checkbox-item">
                                <input type="checkbox" id="in-stock" class="filter-checkbox" checked>
                                <label for="in-stock" class="filter-checkbox-label">En stock</label>
                            </div>
                            <div class="filter-checkbox-item">
                                <input type="checkbox" id="out-stock" class="filter-checkbox">
                                <label for="out-stock" class="filter-checkbox-label">Agotado</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="filter-group">
                        <label class="filter-label">Ordenar por</label>
                        <select id="sort-filter" class="filter-select">
                            <option value="popular">Más populares</option>
                            <option value="newest">Más recientes</option>
                            <option value="price-low">Precio: Menor a Mayor</option>
                            <option value="price-high">Precio: Mayor a Menor</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="search-input" class="filter-label">Buscar</label>
                        <div class="search-group">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" id="search-input" class="search-input" placeholder="Buscar productos...">
                        </div>
                    </div>
                    
                    <div class="filter-actions">
                        <button class="filter-btn filter-btn-apply">Aplicar filtros</button>
                        <button class="filter-btn filter-btn-reset">Reset</button>
                    </div>
                </div>
            </div>
            
            <!-- Contenedor de productos -->
            <div class="products-grid-container">
                <div class="products-header">
                    <div class="products-count">
                        Mostrando <strong><?= count($productos); ?></strong> productos
                    </div>
                    <div class="products-sort">
                        <span class="sort-label">Vista:</span>
                        <select class="sort-select">
                            <option value="grid">Cuadrícula</option>
                            <option value="list">Lista</option>
                        </select>
                    </div>
                </div>

                <?php if (!empty($productos)): ?>
                    <div class="productos-grid">
                        <?php foreach ($productos as $producto): ?>
                            <div class="producto-card">
                                <?php 
                                // Asignar badges aleatorios para demostración
                                $badges = ['new', 'sale', 'hot'];
                                $randomBadge = $badges[array_rand($badges)];
                                if (rand(0, 1)): // 50% de probabilidad de mostrar badge
                                ?>
                                    <div class="producto-badge <?= $randomBadge ?>">
                                        <?= $randomBadge === 'new' ? 'Nuevo' : ($randomBadge === 'sale' ? 'Oferta' : 'Popular') ?>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="producto-img-container">
                                    <?php if (!empty($producto['imagen'])): ?>
                                        <img src="<?= htmlspecialchars($producto['imagen']); ?>" alt="<?= htmlspecialchars($producto['nombre_producto']); ?>" class="producto-img">
                                    <?php else: ?>
                                        <img src="img/default.jpg" alt="<?= htmlspecialchars($producto['nombre_producto']); ?>" class="producto-img">
                                    <?php endif; ?>
                                    
                                    <div class="producto-actions">
                                        <button class="producto-action-btn" title="Añadir a favoritos">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                        <button class="producto-action-btn" title="Vista rápida">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="producto-action-btn" title="Comparar">
                                            <i class="fas fa-exchange-alt"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="producto-content">
                                    <div class="producto-category">
                                        <?php
                                        $categorias = [
                                            1 => 'Vibradores Mujer',
                                            2 => 'Vibradores Hombre',
                                            3 => 'Juguetes para Parejas',
                                            4 => 'Lubricantes',
                                            5 => 'Preservativos',
                                            6 => 'Lencería',
                                            7 => 'BDSM'
                                        ];
                                        echo isset($categorias[$producto['id_categoria']]) ? $categorias[$producto['id_categoria']] : 'Categoría';
                                        ?>
                                    </div>
                                    <h3 class="producto-title">
                                        <a href="?action=producto&id=<?= $producto['id']; ?>"><?= htmlspecialchars($producto['nombre_producto']); ?></a>
                                    </h3>
                                    <p class="producto-description"><?= htmlspecialchars($producto['descripción'] ?? 'Sin descripción disponible'); ?></p>
                                    
                                    <div class="producto-meta">
                                        <div class="producto-price">
                                            <?= number_format($producto['coste'], 2); ?> €
                                            <?php if (rand(0, 1)): // 50% de probabilidad de mostrar precio anterior ?>
                                                <span class="producto-price-old"><?= number_format($producto['coste'] * 1.2, 2); ?> €</span>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <div class="producto-rating">
                                            <?php 
                                            $rating = rand(3, 5);
                                            for ($i = 1; $i <= 5; $i++): 
                                            ?>
                                                <i class="fas fa-star<?= $i <= $rating ? '' : '-o'; ?>"></i>
                                            <?php endfor; ?>
                                            <span class="producto-rating-count">(<?= rand(5, 50); ?>)</span>
                                        </div>
                                    </div>
                                    
                                    <a href="?action=producto&id=<?= $producto['id']; ?>" class="producto-btn">
                                        <i class="fas fa-eye"></i> Ver producto
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="pagination">
                        <a href="#" class="pagination-item disabled"><i class="fas fa-chevron-left"></i></a>
                        <a href="#" class="pagination-item active">1</a>
                        <a href="#" class="pagination-item">2</a>
                        <a href="#" class="pagination-item">3</a>
                        <a href="#" class="pagination-item">4</a>
                        <a href="#" class="pagination-item"><i class="fas fa-chevron-right"></i></a>
                    </div>
                <?php else: ?>
                    <div class="empty-message">
                        <i class="fas fa-box-open"></i>
                        <h3>No hay productos disponibles</h3>
                        <p>Actualmente no hay productos disponibles. Por favor, vuelve más tarde.</p>
                        <a href="?action=portada">
                            <i class="fas fa-home"></i> Volver al inicio
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/footer.php'; ?>
</body>
</html>
