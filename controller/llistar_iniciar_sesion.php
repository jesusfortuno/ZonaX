<?php

require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/iniciar_sesion.php';

$mensaje = ""; // Mensaje inicial vacío

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $contraseña = $_POST['contraseña'];

    // Conexión a la base de datos
    $conection = DB::getInstance();

    // Validar credenciales
    if (verificarUsuario($conection, $nombre, $contraseña)) {
        // Credenciales correctas
        $mensaje = "Inicio de sesión exitoso. Bienvenido, $nombre.";
        $_SESSION['nombre'] = $nombre; // Guardar usuario en sesión
    } else {
        // Credenciales incorrectas
        $mensaje = "Usuario o contraseña incorrectos. Intenta de nuevo.";
    }
}

// Incluir la vista para mostrar el mensaje
include __DIR__ . '/../views/llistar_iniciar_sesion.php';
?>
