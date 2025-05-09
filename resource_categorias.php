<?php
// resource_categorias.php
// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Para desarrollo, mantener los errores pero loguearlos
error_reporting(E_ALL);
ini_set('display_errors', 0); // No mostrar errores en pantalla
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error.log');

// Incluir el modelo de conexión y categorías
require_once __DIR__ . '/model/connectaDb.php';
require_once __DIR__ . '/model/categories.php';

try {
    // Obtener conexión a la base de datos
    $conection = DB::getInstance();
    
    // Obtener categorías de la base de datos
    $categorias = getAllCategories($conection);
    
    // Si no hay categorías en la base de datos, usar datos de ejemplo
    if (empty($categorias)) {
        $categorias = obtenerCategorias();
    }
    
    // Incluir la vista de categorías
    include_once __DIR__ . '/views/categorias.php';
} catch (Exception $e) {
    error_log("Error en resource_categorias.php: " . $e->getMessage());
    // En caso de error, usar datos de ejemplo
    $categorias = obtenerCategorias();
    include_once __DIR__ . '/views/categorias.php';
}
?>
