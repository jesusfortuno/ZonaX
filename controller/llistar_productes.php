<?php
// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Configuración de errores
error_reporting(E_ALL);
ini_set('display_errors', 0); // No mostrar errores en pantalla
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../error.log');

try {
    require_once __DIR__ . '/../model/connectaDb.php';
    require_once __DIR__ . '/../model/productos.php';

    $conection = DB::getInstance();
    $productes = getProductos($conection);

    // Debug
    error_log("Listando todos los productos");
    error_log("Número de productos encontrados: " . count($productes));

    // Incluir la vista
    require_once __DIR__ . '/../views/llistar_productes.php';
} catch (Exception $e) {
    error_log("Error en llistar_productes.php: " . $e->getMessage());
    echo "<p>Ha ocurrido un error al cargar los productos. Por favor, inténtelo de nuevo más tarde.</p>";
}
?>
