<?php
// controller/producto_controller.php
require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/productos.php';

$conection = DB::getInstance(); // Obtener la conexión a la base de datos

// Manejo de errores
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Obtener el ID del producto de la URL
    $id_producto = $_GET['id'] ?? '';
    error_log("ID de producto: " . $id_producto);

    // Obtener detalles del producto
    $producto = getProductoById($conection, $id_producto);
    
    // Verificar si se encontró el producto
    if (empty($producto)) {
        error_log("No se encontró el producto con ID: " . $id_producto);
        $error = "Producto no encontrado.";
    } else {
        error_log("Producto obtenido: " . print_r($producto, true));
    }
} else {
    $error = "Método no permitido.";
}

// Incluir la vista
include __DIR__ . '/../views/producto.php';
?>