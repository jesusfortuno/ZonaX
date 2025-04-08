<?php
if (isset($_SESSION['usuario'])) {
    if ($_SESSION['rol'] === 'admin') {
        include __DIR__ . '/header_admin.php';
    } else {
        include __DIR__ . '/header_usuario.php';
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
                            <a href="index.php?action=detalle-producto&id=<?php echo $producte['id']; ?>" class="ver-mas">Ver más <i class="fas fa-arrow-right"></i></a>
                        </div>
                        <div class="precio-container">
                            <p class="precio"><?php echo number_format($producte['coste'], 2); ?>€</p>
                        </div>
                        <?php if (isset($_SESSION['usuario'])) : ?>
                            <button class="add-to-cart" data-product-id="<?php echo $producte['id']; ?>">
                                <i class="fas fa-cart-plus"></i> Comprar
                            </button>
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
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: all 0.4s ease;
    position: relative;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.producto-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
}

.imagen-container {
    position: relative;
    height: 300px;
    overflow: hidden;
}

.producto-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}

.producto-card:hover img {
    transform: scale(1.1);
}

.producto-info {
    padding: 2rem;
    background: linear-gradient(135deg, var(--color-blanco) 0%, var(--color-rosa-claro) 100%);
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.producto-titulo {
    color: var(--color-naranja);
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.descripcion-container {
    margin-bottom: 1.5rem;
    position: relative;
}

.descripcion {
    color: #555;
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 0.5rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    max-height: 3.5em; /* 2 líneas x 1.6 line-height + un poco extra */
}

.ver-mas {
    color: var(--color-rosa);
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    font-size: 1rem;
    transition: all 0.3s ease;
    position: relative;
    z-index: 2;
    background-color: rgba(255, 255, 255, 0.7);
    padding: 2px 5px;
    border-radius: 4px;
    margin-top: 5px;
}

.ver-mas:hover {
    color: var(--color-naranja);
    transform: translateX(5px);
}

.ver-mas i {
    font-size: 0.8rem;
}

.precio-container {
    background: linear-gradient(45deg, var(--color-amarillo), var(--color-naranja));
    padding: 0.8rem 1.5rem;
    border-radius: 30px;
    display: inline-block;
    margin-bottom: 1.5rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.precio {
    font-size: 1.8rem;
    font-weight: bold;
    color: var(--color-blanco);
    margin: 0;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
}

.add-to-cart {
    width: 100%;
    padding: 1.2rem;
    background: linear-gradient(45deg, var(--color-rosa), var(--color-naranja));
    color: var(--color-blanco);
    border: none;
    border-radius: 30px;
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
    margin-top: auto;
}

.add-to-cart:hover {
    background: linear-gradient(45deg, var(--color-naranja), var(--color-rosa));
    transform: scale(1.02);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
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
</style>

<!-- Añadir Font Awesome para los iconos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<?php if (isset($_SESSION['usuario'])) : ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.productId;
            
            // Cambiar el texto y estilo del botón al hacer clic
            this.innerHTML = '<i class="fas fa-check"></i> Producto añadido';
            this.style.background = 'linear-gradient(45deg, #4CAF50, #8BC34A)';
            
            // Deshabilitar el botón temporalmente
            this.disabled = true;
            
            // Después de 2 segundos, restaurar el botón
            setTimeout(() => {
                this.innerHTML = '<i class="fas fa-cart-plus"></i> Comprar';
                this.style.background = 'linear-gradient(45deg, var(--color-rosa), var(--color-naranja))';
                this.disabled = false;
            }, 2000);
            
            // Aquí puedes añadir la lógica para agregar al carrito usando AJAX
            // Por ejemplo:
            fetch('index.php?action=agregar-al-carrito', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'producto_id=' + productId
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Actualizar contador del carrito si es necesario
                    if (document.querySelector('.cart-counter')) {
                        document.querySelector('.cart-counter').textContent = data.total_items;
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});
</script>
<?php endif; ?>
