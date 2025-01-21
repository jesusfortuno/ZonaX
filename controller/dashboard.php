<?php
require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/usuarios.php';

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header('Location: ?action=portada');
    exit();
}

$connection = DB::getInstance();
$stats = [
    'total_usuarios' => contarUsuarios($connection),
    'total_productos' => contarProductos($connection),
    'total_categorias' => contarCategorias($connection)
];

include __DIR__ . '/../views/dashboard.php';
?>