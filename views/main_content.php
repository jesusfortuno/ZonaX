<div class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">Descubre tu <span>Placer</span></h1>
        <p class="hero-subtitle">Explora nuestra colección exclusiva de productos para elevar tu experiencia</p>
        <a href="?action=llistar-productes" class="hero-button">
            Ver Productos <i class="fas fa-arrow-right"></i>
        </a>
    </div>
</div>

<div class="categories-section">
    <div class="section-header">
        <h2 class="section-title">Nuestras Categorías</h2>
        <p class="section-subtitle">Encuentra lo que buscas en nuestras categorías seleccionadas</p>
    </div>

    <div class="categories-grid">
        <!-- Categoría 1 -->
        <a href="index.php?action=categoria&categoria=1" class="category-card">
            <div class="category-image-container">
                <img src="img/vibrador-mujer.png" alt="Vibradores Mujer" class="category-image">
                <span class="category-tag popular">Popular</span>
            </div>
            <div class="category-info">
                <h3 class="category-title">VIBRADORES MUJER</h3>
                <span class="category-link">Ver productos <i class="fas fa-chevron-right"></i></span>
            </div>
        </a>

        <!-- Categoría 2 -->
        <a href="index.php?action=categoria&categoria=2" class="category-card">
            <div class="category-image-container">
                <img src="img/vibrador-hombre.png" alt="Vibradores Hombre" class="category-image">
                <span class="category-tag destacado">Destacado</span>
            </div>
            <div class="category-info">
                <h3 class="category-title">VIBRADORES HOMBRE</h3>
                <span class="category-link">Ver productos <i class="fas fa-chevron-right"></i></span>
            </div>
        </a>

        <!-- Categoría 3 -->
        <a href="index.php?action=categoria&categoria=3" class="category-card">
            <div class="category-image-container">
                <img src="img/jueguete-pareja.png" alt="Juguetes para Parejas" class="category-image">
                <span class="category-tag parejas">Parejas</span>
            </div>
            <div class="category-info">
                <h3 class="category-title">JUGUETES PARA PAREJAS</h3>
                <span class="category-link">Ver productos <i class="fas fa-chevron-right"></i></span>
            </div>
        </a>

        <!-- Categoría 4 -->
        <a href="index.php?action=categoria&categoria=4" class="category-card">
            <div class="category-image-container">
                <img src="img/lubricantes.png" alt="Lubricantes" class="category-image">
                <span class="category-tag esencial">Esencial</span>
            </div>
            <div class="category-info">
                <h3 class="category-title">LUBRICANTES</h3>
                <span class="category-link">Ver productos <i class="fas fa-chevron-right"></i></span>
            </div>
        </a>

        <!-- Categoría 5 -->
        <a href="index.php?action=categoria&categoria=6" class="category-card">
            <div class="category-image-container">
                <img src="img/lenceria.png" alt="Lencería" class="category-image">
                <span class="category-tag sensual">Sensual</span>
            </div>
            <div class="category-info">
                <h3 class="category-title">LENCERÍA</h3>
                <span class="category-link">Ver productos <i class="fas fa-chevron-right"></i></span>
            </div>
        </a>

        <!-- Categoría 6 -->
        <a href="index.php?action=categoria&categoria=7" class="category-card">
            <div class="category-image-container">
                <img src="img/bdsm.png" alt="BDSM" class="category-image">
                <span class="category-tag bdsm">BDSM</span>
            </div>
            <div class="category-info">
                <h3 class="category-title">BDSM</h3>
                <span class="category-link">Ver productos <i class="fas fa-chevron-right"></i></span>
            </div>
        </a>
    </div>
</div>

<div class="featured-section">
    <div class="section-header">
        <h2 class="section-title">Productos Destacados</h2>
        <p class="section-subtitle">Los favoritos de nuestros clientes</p>
    </div>
    
    <div class="featured-slider">
        <?php
        // Incluir el controlador de productos destacados
        include_once __DIR__ . '/../controller/productos_destacados_controller.php';
        
        // Verificar si hay productos destacados
        if (!empty($productosDestacados)):
            foreach ($productosDestacados as $producto):
        ?>
        <div class="featured-product">
            <div class="product-image-container">
                <?php if (!empty($producto['imagen'])): ?>
                    <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre_producto']); ?>" class="product-image">
                <?php else: ?>
                    <img src="img/default.jpg" alt="Imagen no disponible" class="product-image">
                <?php endif; ?>
                <div class="product-overlay">
                    <a href="?action=producto&id=<?php echo $producto['id']; ?>" class="quick-view-btn"><i class="fas fa-eye"></i> Vista Rápida</a>
                </div>
            </div>
            <div class="product-info">
                <h3 class="product-title"><?php echo htmlspecialchars($producto['nombre_producto']); ?></h3>
                <p class="product-price"><?php echo number_format($producto['coste'], 2); ?>€</p>
                <form action="index.php?action=carrito&op=add" method="post">
                    <input type="hidden" name="id_producto" value="<?php echo $producto['id']; ?>">
                    <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($producto['nombre_producto']); ?>">
                    <input type="hidden" name="precio" value="<?php echo $producto['coste']; ?>">
                    <input type="hidden" name="imagen" value="<?php echo htmlspecialchars($producto['imagen']); ?>">
                    <input type="hidden" name="cantidad" value="1">
                    <button type="submit" class="add-to-cart-btn"><i class="fas fa-shopping-cart"></i> Añadir al Carrito</button>
                </form>
            </div>
        </div>
        <?php
            endforeach;
        else:
        ?>
        <!-- Productos por defecto en caso de que no haya productos en la base de datos -->
        <div class="featured-product">
            <div class="product-image-container">
                <img src="img/featured-1.png" alt="Vibrador Premium" class="product-image">
                <div class="product-overlay">
                    <a href="#" class="quick-view-btn"><i class="fas fa-eye"></i> Vista Rápida</a>
                </div>
            </div>
            <div class="product-info">
                <h3 class="product-title">Vibrador Premium</h3>
                <p class="product-price">49.99€</p>
                <a href="#" class="add-to-cart-btn"><i class="fas fa-shopping-cart"></i> Añadir al Carrito</a>
            </div>
        </div>
        
        <div class="featured-product">
            <div class="product-image-container">
                <img src="img/featured-2.png" alt="Set de Parejas" class="product-image">
                <div class="product-overlay">
                    <a href="#" class="quick-view-btn"><i class="fas fa-eye"></i> Vista Rápida</a>
                </div>
            </div>
            <div class="product-info">
                <h3 class="product-title">Set de Parejas</h3>
                <p class="product-price">59.99€</p>
                <a href="#" class="add-to-cart-btn"><i class="fas fa-shopping-cart"></i> Añadir al Carrito</a>
            </div>
        </div>
        
        <div class="featured-product">
            <div class="product-image-container">
                <img src="img/featured-3.png" alt="Lubricante Premium" class="product-image">
                <div class="product-overlay">
                    <a href="#" class="quick-view-btn"><i class="fas fa-eye"></i> Vista Rápida</a>
                </div>
            </div>
            <div class="product-info">
                <h3 class="product-title">Lubricante Premium</h3>
                <p class="product-price">19.99€</p>
                <a href="#" class="add-to-cart-btn"><i class="fas fa-shopping-cart"></i> Añadir al Carrito</a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<div class="white-container">
    <div class="cta-section">
        <div class="cta-content">
            <h2 class="cta-title">¿Listo para explorar?</h2>
            <p class="cta-text">Descubre nuestra colección completa de productos</p>
            <a href="?action=llistar-productes" class="cta-button">Ver Todos los Productos</a>
        </div>
    </div>
</div>

<style>
:root {
    --color-primary: #ff6b6b;
    --color-primary-light: #fca5a5;
    --color-primary-dark: #ef4444;
    --color-secondary: #fb923c;
    --color-secondary-light: #fdba74;
    --color-accent: #fbbf24;
    --color-white: #ffffff;
    --color-black: #111827;
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

/* Hero Section */
.hero-section {
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://hebbkx1anhila5yf.public.blob.vercel-storage.com/attachments/gen-images/public/images/hero-background-ofonefID08DyemqDv4wmDuXyTd3niN.png');
    background-size: cover;
    background-position: center;
    color: var(--color-white);
    padding: 8rem 2rem;
    text-align: center;
    position: relative;
}

.hero-content {
    max-width: 800px;
    margin: 0 auto;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.hero-title span {
    color: var(--color-primary);
    position: relative;
    display: inline-block;
}

.hero-title span::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 100%;
    height: 3px;
    background: var(--color-primary);
}

.hero-subtitle {
    font-size: 1.25rem;
    margin-bottom: 2.5rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.hero-button {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--color-primary);
    color: var(--color-white);
    padding: 1rem 2rem;
    border-radius: var(--border-radius-md);
    text-decoration: none;
    font-weight: 600;
    transition: var(--transition-fast);
    text-transform: uppercase;
    letter-spacing: 1px;
}

.hero-button:hover {
    background: var(--color-primary-dark);
    transform: translateY(-3px);
    box-shadow: var(--shadow-md);
}

/* Section Styles */
.section-header {
    text-align: center;
    margin-bottom: 3rem;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: var(--color-gray-800);
    position: relative;
    display: inline-block;
    padding-bottom: 0.5rem;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 3px;
    background: var(--gradient-main);
    border-radius: 3px;
}

.section-subtitle {
    font-size: 1.1rem;
    color: var(--color-gray-600);
    max-width: 600px;
    margin: 0 auto;
}

/* Categories Section */
.categories-section {
    padding: 5rem 2rem;
    background-color: var(--color-gray-50);
}

.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.category-card {
    background: var(--color-white);
    border-radius: var(--border-radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-md);
    transition: var(--transition-fast);
    text-decoration: none;
    color: var(--color-gray-800);
    display: flex;
    flex-direction: column;
    height: 100%;
    border: 1px solid var(--color-gray-200);
}

.category-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-lg);
}

.category-image-container {
    position: relative;
    padding-top: 75%; /* 4:3 Aspect Ratio */
    overflow: hidden;
    background: linear-gradient(135deg, #f8f9fa, #ffffff);
}

.category-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 1.5rem;
    transition: transform 0.5s ease;
}

.category-card:hover .category-image {
    transform: scale(1.1);
}

.category-tag {
    position: absolute;
    top: 1rem;
    right: 1rem;
    padding: 0.35rem 1rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    z-index: 2;
}

.category-tag.popular {
    background-color: #ff6b6b;
    color: white;
}

.category-tag.destacado {
    background-color: #ffa36b;
    color: white;
}

.category-tag.parejas {
    background-color: #ffd56b;
    color: var(--color-gray-800);
}

.category-tag.esencial {
    background-color: #ff9eb6;
    color: white;
}

.category-tag.sensual {
    background-color: #ffa36b;
    color: white;
}

.category-tag.bdsm {
    background-color: #333;
    color: white;
}

.category-info {
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    position: relative;
    background: linear-gradient(135deg, #ffffff 0%, #fff5f8 100%);
}

.category-info::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: var(--gradient-main);
}

.category-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: var(--color-gray-800);
}

.category-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--color-primary);
    font-weight: 500;
    font-size: 0.9rem;
    margin-top: auto;
    transition: var(--transition-fast);
}

.category-card:hover .category-link {
    color: var(--color-primary-dark);
    gap: 0.75rem;
}

/* Featured Products Section */
.featured-section {
    padding: 5rem 2rem;
    background-color: var(--color-white);
    margin-bottom: 0;
    padding-bottom: 5rem;
}

.featured-slider {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.featured-product {
    background: var(--color-white);
    border-radius: var(--border-radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-md);
    transition: var(--transition-fast);
    border: 1px solid var(--color-gray-200);
}

.featured-product:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-lg);
}

.product-image-container {
    position: relative;
    padding-top: 100%; /* 1:1 Aspect Ratio */
    overflow: hidden;
    background: linear-gradient(135deg, #f8f9fa, #ffffff);
}

.product-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 1.5rem;
    transition: transform 0.5s ease;
}

.featured-product:hover .product-image {
    transform: scale(1.1);
}

.product-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: var(--transition-fast);
}

.featured-product:hover .product-overlay {
    opacity: 1;
}

.quick-view-btn {
    background: var(--color-white);
    color: var(--color-gray-800);
    padding: 0.75rem 1.5rem;
    border-radius: var(--border-radius-md);
    text-decoration: none;
    font-weight: 500;
    transition: var(--transition-fast);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.quick-view-btn:hover {
    background: var(--color-primary);
    color: var(--color-white);
}

.product-info {
    padding: 1.5rem;
    text-align: center;
}

.product-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: var(--color-gray-800);
}

.product-price {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--color-primary);
    margin-bottom: 1rem;
}

.add-to-cart-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--gradient-main);
    color: var(--color-white);
    padding: 0.75rem 1.5rem;
    border-radius: var(--border-radius-md);
    text-decoration: none;
    font-weight: 500;
    transition: var(--transition-fast);
    width: 100%;
    justify-content: center;
}

.add-to-cart-btn:hover {
    background: linear-gradient(90deg, var(--color-primary-dark), var(--color-secondary));
    transform: translateY(-3px);
    box-shadow: var(--shadow-md);
}

/* CTA Section */
.white-container {
    width: 100%;
    background-color: var(--color-white);
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0;
    margin: 0;
}

.cta-section {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 6rem 2rem;
    text-align: center;
    position: relative;
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-AkgWxqgG19hgpZ8KpxCNY04wp9wVgo.png');
    background-size: cover;
    background-position: center;
    color: var(--color-white);
    overflow: hidden;
}

.cta-content {
    max-width: 800px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}

.cta-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
}

.cta-text {
    font-size: 1.25rem;
    margin-bottom: 2rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
}

.cta-button {
    display: inline-block;
    background: var(--color-primary);
    color: var(--color-white);
    padding: 1rem 2rem;
    border-radius: var(--border-radius-md);
    text-decoration: none;
    font-weight: 600;
    transition: var(--transition-fast);
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: 0 4px 10px rgba(255, 107, 107, 0.3);
    border: 2px solid rgba(255, 255, 255, 0.2);
}

.cta-button:hover {
    background: var(--color-primary-dark);
    transform: translateY(-3px);
    box-shadow: 0 6px 15px rgba(255, 107, 107, 0.4);
}

/* Responsive Styles */
@media (max-width: 992px) {
    .hero-title {
        font-size: 3rem;
    }
    
    .section-title {
        font-size: 2.25rem;
    }
    
    .cta-title {
        font-size: 2.25rem;
    }
}

@media (max-width: 768px) {
    .hero-section {
        padding: 6rem 1.5rem;
    }
    
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .categories-grid, 
    .featured-slider {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
    }
    
    .section-title {
        font-size: 2.25rem;
    }
    
    .cta-title {
        font-size: 2.25rem;
    }
}

@media (max-width: 576px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-button,
    .cta-button {
        padding: 0.875rem 1.5rem;
    }
    
    .categories-grid, 
    .featured-slider {
        grid-template-columns: 1fr;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .cta-section {
        padding: 4rem 1.5rem;
    }
    
    .cta-title {
        font-size: 2rem;
    }
}

/* Eliminar espacios entre secciones */
.featured-section {
    margin-bottom: 0;
    padding-bottom: 5rem;
}

body {
    margin: 0;
    padding: 0;
    overflow-x: hidden;
    background-color: var(--color-white);
}

.cta-section + div {
    margin-top: 0;
    padding-top: 0;
}
</style>

<?php include __DIR__ . '/footer.php'; ?>
