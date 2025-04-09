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

    $conection = DB::getInstance(); // Obtener la conexión a la base de datos

    // Manejo de errores
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Obtener el ID del producto de la URL
        $id_producto = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        error_log("ID de producto: " . $id_producto);

        // Obtener detalles del producto
        $producto = getProductoById($conection, $id_producto);
        
        // Verificar si se encontró el producto
        if (empty($producto)) {
            error_log("No se encontró el producto con ID: " . $id_producto);
            $error = "Producto no encontrado.";
        } else {
            error_log("Producto obtenido con ID: " . $id_producto);
        }
    } else {
        $error = "Método no permitido.";
        error_log("Método no permitido en producto_controller.php");
    }

    // Incluir la vista
    require_once __DIR__ . '/../views/producto.php';
} catch (Exception $e) {
    error_log("Error en producto_controller.php: " . $e->getMessage());
    echo "<p>Ha ocurrido un error al cargar el producto. Por favor, inténtelo de nuevo más tarde.</p>";
}
?>
