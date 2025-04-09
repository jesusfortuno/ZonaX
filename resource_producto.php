<?php
// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Configuración de errores
error_reporting(E_ALL);
ini_set('display_errors', 0); // No mostrar errores en pantalla
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error.log');
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto - TDIW</title>
</head>
<body>
    <div class="container">
        <?php 
        try {
            require __DIR__ . '/controller/producto_controller.php';
        } catch (Exception $e) {
            error_log("Error al cargar el controlador: " . $e->getMessage());
            echo "<p>Ha ocurrido un error al cargar la página. Por favor, inténtelo de nuevo más tarde.</p>";
        }
        ?>
    </div>
</body>
</html>
