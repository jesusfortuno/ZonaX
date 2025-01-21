<nav>
    <?php if (isset($_SESSION['usuario'])): ?>
        <span style="color: white; margin-right: 1rem;">Administrador: <?= htmlspecialchars($_SESSION['usuario']); ?></span>
    <?php endif; ?>
    <a href="?action=dashboard">Dashboard</a>
    <a href="?action=gestionar-productos">Gestionar Productos</a>
    <a href="?action=llistar-categories">Categorías</a>
    <a href="?action=salir">Cerrar Sesión</a>
</nav>
