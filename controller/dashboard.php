<?php
require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/usuarios.php';
require_once __DIR__ . '/../model/categories.php';

// No iniciamos sesión aquí porque ya se inicia en index.php
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
   header('Location: ?action=portada');
   exit();
}

// Obtener la conexión a la base de datos usando el método correcto
$connection = DB::getInstance();

// Obtener estadísticas
$stats = [
   'total_usuarios' => contarUsuarios($connection),
   'total_productos' => contarProductos($connection),
   'total_categorias' => contarCategorias($connection)
];

// Cargar la vista
include __DIR__ . '/../views/dashboard.php';
?>
