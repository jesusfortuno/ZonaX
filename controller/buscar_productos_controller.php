<?php

require_once __DIR__ . '/../model/connectaDB.php';
require_once __DIR__ . '/../model/products.php';

$conexion = DB::getInstance();

// Manejo de la solicitud AJAX para filtrar productos
if (isset($_GET['nombre'])) {
    $nombre = $_GET['nombre'];
    $productos = buscarProductosPorNombre($conexion, $nombre);
}

// Si no es AJAX, mostramos la vista inicial
include __DIR__ . '/../views/buscar_productos.php';

?>
