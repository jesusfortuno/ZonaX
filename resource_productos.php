<?php
// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Desactivar la visualización de errores en producción
// error_reporting(0);
// ini_set('display_errors', 0);

// Para desarrollo, mantener los errores pero loguearlos
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
    <title>Llistat de productos - TDIW</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
        <?php 
        try {
            require __DIR__ . '/controller/llistar_productes.php';
        } catch (Exception $e) {
            error_log("Error al cargar el controlador: " . $e->getMessage());
            echo "<p>Ha ocurrido un error al cargar la página. Por favor, inténtelo de nuevo más tarde.</p>";
        }
        ?>
    </div>
</body>
</html>
