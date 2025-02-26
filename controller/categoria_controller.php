<?php
require_once __DIR__ . '/../model/connectaDb.php'; // Asegúrate de que la ruta sea correcta
require_once __DIR__ . '/../model/productos.php'; // Asegúrate de que la ruta sea correcta

$conection = DB::getInstance(); // Obtener la conexión a la base de datos

// Manejo de errores
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Obtener la categoría de la URL
    $id_categoria = $_GET['categoria'] ?? '';
    error_log("ID de categoría: " . $id_categoria);

    // Obtener productos según la categoría
    $productos = getProductosByCategoria($conection, $id_categoria);
    
    // Verificar si se encontraron productos
    if (empty($productos)) {
        error_log("No se encontraron productos para la categoría: " . $id_categoria);
    } else {
        error_log("Productos obtenidos: " . print_r($productos, true));
    }
} else {
    $error = "Método no permitido.";
}

// Incluir la vista
include __DIR__ . '/../views/categoria.php'; // Asegúrate de que la ruta sea correcta
?>