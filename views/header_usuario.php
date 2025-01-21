<nav>
    <?php if (isset($_SESSION['usuario'])): ?>
        <span style="color: white; margin-right: 1rem;">Bienvenido, <?= htmlspecialchars($_SESSION['usuario']); ?></span>
    <?php endif; ?>
    <a href="#">Productos</a>
    <a href="?action=llistar-categories">Categorías</a>
    <a href="?action=registre">Cuenta</a>
    <a href="#">Carrito</a>
</nav>
