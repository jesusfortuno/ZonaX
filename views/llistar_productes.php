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
    <?php if (!empty($productes)) : ?>
        <div class="productos-grid">
            <?php foreach ($productes as $producte) : ?>
                <div class="producto-card">
                    <?php if (!empty($producte['imagen'])) : ?>
                        <img src="<?php echo htmlspecialchars($producte['imagen']); ?>" alt="<?php echo htmlspecialchars($producte['nombre_producto']); ?>">
                    <?php endif; ?>
                    <div class="producto-info">
                        <h3><?php echo htmlspecialchars($producte['nombre_producto']); ?></h3>
                        <p class="descripcion"><?php echo htmlspecialchars($producte['descripción']); ?></p>
                        <p class="precio"><?php echo number_format($producte['coste'], 2); ?>€</p>
                        <?php if (isset($_SESSION['usuario'])) : ?>
                            <button class="add-to-cart" data-product-id="<?php echo $producte['id']; ?>">
                                Añadir al carrito
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <div class="no-productos">
            <p>No hay productos disponibles.</p>
        </div>
    <?php endif; ?>
</div>

<style>
.productos-container {
    padding: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.productos-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 2rem;
}

.producto-card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: transform 0.3s ease;
}

.producto-card:hover {
    transform: translateY(-5px);
}

.producto-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.producto-info {
    padding: 1rem;
}

.producto-info h3 {
    margin: 0 0 0.5rem 0;
    color: #333;
}

.descripcion {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

.precio {
    font-size: 1.2rem;
    font-weight: bold;
    color: #2c3e50;
    margin-bottom: 1rem;
}

.add-to-cart {
    width: 100%;
    padding: 0.8rem;
    background-color: #333;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.add-to-cart:hover {
    background-color: #444;
}

.no-productos {
    text-align: center;
    padding: 2rem;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
</style>

<?php if (isset($_SESSION['usuario'])) : ?>
<script>
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function() {
        const productId = this.dataset.productId;
        // Aquí puedes añadir la lógica para agregar al carrito
        alert('Producto añadido al carrito');
    });
});
</script>
<?php endif; 
?>