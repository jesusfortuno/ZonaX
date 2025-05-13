<?php
// resource_productos.php
// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Para desarrollo, mantener los errores pero loguearlos
error_reporting(E_ALL);
ini_set('display_errors', 0); // No mostrar errores en pantalla
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error.log');

// Incluir el modelo de conexión y productos
require_once __DIR__ . '/model/connectaDb.php';
require_once __DIR__ . '/model/productos.php';

try {
    // Obtener conexión a la base de datos
    $conection = DB::getInstance();
    
    // Obtener productos de la base de datos
    $productos = getProductos($conection);
    
    // Si no hay productos en la base de datos, usar datos de ejemplo
    if (empty($productos)) {
        $productos = obtenerProductos();
    }
    
    // Incluir la vista de productos
    include_once __DIR__ . '/views/llistar_productes.php';
} catch (Exception $e) {
    error_log("Error en resource_productos.php: " . $e->getMessage());
    // En caso de error, usar datos de ejemplo
    $productos = obtenerProductos();
    include_once __DIR__ . '/views/llistar_productes.php';
}
?>
