<?php
// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Configuración de errores
error_reporting(E_ALL);
ini_set('display_errors', 0); // No mostrar errores en pantalla
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../error.log');

// Incluir headers según el rol del usuario
if (isset($_SESSION['usuario'])) {
    if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin') {
        include_once __DIR__ . '/header_admin.php';
    } else {
        include_once __DIR__ . '/header_usuario.php';
    }
}
?>

<div class="productos-container">
    <h1 class="titulo-seccion">NUESTROS PRODUCTOS</h1>
    <?php if (!empty($productes)) : ?>
        <div class="productos-grid">
            <?php foreach ($productes as $producte) : ?>
                <div class="producto-card">
                    <?php if (!empty($producte['imagen'])) : ?>
                        <div class="imagen-container">
                            <img src="<?php echo htmlspecialchars($producte['imagen']); ?>" alt="<?php echo htmlspecialchars($producte['nombre_producto']); ?>">
                        </div>
                    <?php endif; ?>
                    <div class="producto-info">
                        <h3 class="producto-titulo"><?php echo htmlspecialchars($producte['nombre_producto']); ?></h3>
                        <div class="descripcion-container">
                            <p class="descripcion"><?php echo htmlspecialchars($producte['descripción']); ?></p>
                            <a href="index.php?action=producto&id=<?php echo $producte['id']; ?>" class="ver-mas">Ver más <i class="fas fa-arrow-right"></i></a>
                        </div>
                        <div class="precio-container">
                            <p class="precio"><?php echo number_format($producte['coste'], 2); ?>€</p>
                        </div>
                        <?php if (isset($_SESSION['usuario'])) : ?>
                            <form action="index.php?action=carrito&op=add" method="post" class="form-comprar">
                                <input type="hidden" name="id_producto" value="<?php echo $producte['id']; ?>">
                                <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($producte['nombre_producto']); ?>">
                                <input type="hidden" name="precio" value="<?php echo $producte['coste']; ?>">
                                <input type="hidden" name="imagen" value="<?php echo htmlspecialchars($producte['imagen']); ?>">
                                <input type="hidden" name="cantidad" value="1">
                                <button type="submit" class="add-to-cart">
                                    <i class="fas fa-cart-plus"></i> Comprar
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <div class="no-productos">
            <p>¡Ups! Parece que no hay productos disponibles en este momento.</p>
            <p class="secondary-text">Vuelve a intentarlo más tarde</p>
        </div>
    <?php endif; ?>
</div>

<style>
/* Definición de variables de color */
:root {
    --color-rosa: #FF69B4;
    --color-naranja: #FFA500;
    --color-amarillo: #FFD700;
    --color-blanco: #FFFFFF;
    --color-rosa-claro: #FFB6C1;
    --color-naranja-claro: #FFD580;
}

.titulo-seccion {
    text-align: center;
    color: var(--color-rosa);
    font-size: 3rem;
    margin: 2rem 0;
    text-transform: uppercase;
    letter-spacing: 3px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    font-weight: bold;
}

.productos-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 2.5rem;
    padding: 2rem;
    max-width: 1400px;
    margin: 0 auto;
}

.producto-card {
    background: var(--color-blanco);
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    overflow: hidden;
    transition: all 0.4s ease;
    position: relative;
    display: flex;
    flex-direction: column;
    height: 100%;
    animation: fadeIn 0.6s ease-out forwards;
    border: 1px solid rgba(0,0,0,0.05);
}

.producto-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(255, 105, 180, 0.15);
    border-color: rgba(255, 105, 180, 0.2);
}

.imagen-container {
    position: relative;
    height: 300px;
    overflow: hidden;
    background: linear-gradient(45deg, #f8f9fa, #ffffff);
    display: flex;
    align-items: center;
    justify-content: center;
}

.producto-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}

.producto-card:hover img {
    transform: scale(1.08);
}

.producto-info {
    padding: 1.8rem;
    background: linear-gradient(135deg, #ffffff 0%, #fff5f8 100%);
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    position: relative;
    z-index: 1;
}

.producto-info::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 6px;
    background: linear-gradient(90deg, #ff6b6b, #ffa36b);
    z-index: 2;
}

.producto-titulo {
    color: #333;
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 1rem;
    line-height: 1.3;
    transition: color 0.3s ease;
}

.producto-card:hover .producto-titulo {
    color: #ff6b6b;
}

.descripcion-container {
    margin-bottom: 1.5rem;
    position: relative;
}

.descripcion {
    color: #666;
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 0.5rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    max-height: 3.5em;
}

.ver-mas {
    color: #ff6b6b;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    font-size: 1rem;
    transition: all 0.3s ease;
    position: relative;
    z-index: 2;
    padding: 2px 8px;
    border-radius: 4px;
    margin-top: 5px;
}

.ver-mas::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background: #ff6b6b;
    transition: width 0.3s ease;
}

.ver-mas:hover {
    color: #ffa36b;
    transform: translateX(5px);
}

.ver-mas:hover::after {
    width: 100%;
}

.ver-mas i {
    font-size: 0.8rem;
    transition: transform 0.3s ease;
}

.ver-mas:hover i {
    transform: translateX(3px);
}

.precio-container {
    background: linear-gradient(45deg, #ff6b6b, #ffa36b);
    padding: 0.8rem 1.5rem;
    border-radius: 50px;
    display: inline-block;
    margin-bottom: 1.5rem;
    box-shadow: 0 4px 15px rgba(255, 105, 180, 0.2);
    position: relative;
    overflow: hidden;
}

.precio-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0));
    z-index: 1;
}

.precio {
    font-size: 1.8rem;
    font-weight: bold;
    color: var(--color-blanco);
    margin: 0;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
    position: relative;
    z-index: 2;
}

.form-comprar {
    width: 100%;
    margin-top: auto;
}

.add-to-cart {
    width: 100%;
    padding: 1.2rem;
    background: linear-gradient(45deg, #ff6b6b, #ffa36b);
    color: var(--color-blanco);
    border: none;
    border-radius: 50px;
    cursor: pointer;
    font-size: 1.2rem;
    font-weight: 600;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(255, 105, 180, 0.15);
}

.add-to-cart::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, rgba(255,255,255,0), rgba(255,255,255,0.2), rgba(255,255,255,0));
    transition: left 0.7s ease;
}

.add-to-cart:hover::before {
    left: 100%;
}

.add-to-cart:hover {
    transform: translateY(-3px);
    box-shadow: 0 7px 20px rgba(255, 105, 180, 0.25);
}

.add-to-cart i {
    font-size: 1.3rem;
    transition: transform 0.3s ease;
}

.add-to-cart:hover i {
    transform: scale(1.2);
}

.add-to-cart:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.no-productos {
    text-align: center;
    padding: 3rem;
    background: linear-gradient(45deg, var(--color-rosa-claro), var(--color-naranja-claro));
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.no-productos p {
    color: #333;
    font-size: 1.5rem;
    margin-bottom: 1rem;
}

.no-productos .secondary-text {
    color: #666;
    font-size: 1.1rem;
}

/* Animaciones */
@keyframes fadeIn {
    from { 
        opacity: 0; 
        transform: translateY(30px); 
    }
    to { 
        opacity: 1; 
        transform: translateY(0); 
    }
}

.producto-card {
    animation: fadeIn 0.6s ease-out forwards;
}

/* Responsive */
@media (max-width: 768px) {
    .productos-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        padding: 1rem;
    }
    
    .titulo-seccion {
        font-size: 2.5rem;
        margin: 1.5rem 0;
    }

    .producto-titulo {
        font-size: 1.5rem;
    }

    .precio {
        font-size: 1.5rem;
    }
}

footer {
    text-align: center;
    padding: 1.5rem 0;
    background-color: #ff6b6b;
    color: white;
    font-size: 0.9rem;
    margin-top: 3rem;
}

footer p {
    margin: 0;
}

footer {
    display: none; /* Hide the old footer */
}
</style>

<!-- Añadir Font Awesome para los iconos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<?php if (isset($_SESSION['usuario'])) : ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.form-comprar').forEach(form => {
        form.addEventListener('submit', function(e) {
            // No prevenimos el evento por defecto para permitir que el formulario se envíe
            const button = this.querySelector('.add-to-cart');
            
            // Cambiar el texto y estilo del botón al hacer clic
            button.innerHTML = '<i class="fas fa-check"></i> Producto añadido';
            button.style.background = 'linear-gradient(45deg, #4CAF50, #8BC34A)';
        });
    });
});
</script>
<?php endif; ?>

<?php include __DIR__ . '/footer.php'; ?>
