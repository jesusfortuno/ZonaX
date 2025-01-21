<?php include 'header_admin.php'; ?>

<div class="dashboard-container">
    <h1>Panel de Administración</h1>
    
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total Usuarios</h3>
            <p><?= $stats['total_usuarios'] ?></p>
        </div>
        <div class="stat-card">
            <h3>Total Productos</h3>
            <p><?= $stats['total_productos'] ?></p>
        </div>
        <div class="stat-card">
            <h3>Total Categorías</h3>
            <p><?= $stats['total_categorias'] ?></p>
        </div>
    </div>

    <div class="admin-actions">
        <h2>Acciones Rápidas</h2>
        <div class="action-buttons">
            <a href="?action=gestionar-productos" class="btn">Gestionar Productos</a>
            <a href="?action=gestionar-usuarios" class="btn">Gestionar Usuarios</a>
            <a href="?action=gestionar-categorias" class="btn">Gestionar Categorías</a>
        </div>
    </div>
</div>

<style>
.dashboard-container {
    padding: 2rem;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.stat-card {
    background: white;
    padding: 1.5rem;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    text-align: center;
}

.admin-actions {
    background: white;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.action-buttons {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
}

.btn {
    background: #333;
    color: white;
    padding: 0.8rem 1.5rem;
    border-radius: 4px;
    text-decoration: none;
    transition: background 0.3s;
}

.btn:hover {
    background: #444;
}
</style>