<?php

require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/iniciar_sesion.php';

$mensaje = ""; // Mensaje inicial vacío

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Conexión a la base de datos
    $conection = DB::getInstance();

    // Validar credenciales
    if (verificarUsuario($conection, $username, $password)) {
        // Credenciales correctas
        $mensaje = "Inicio de sesión exitoso. Bienvenido, $username.";
        $_SESSION['username'] = $username; // Guardar usuario en sesión
    } else {
        // Credenciales incorrectas
        $mensaje = "Usuario o contraseña incorrectos. Intenta de nuevo.";
    }
}

// Incluir la vista para mostrar el mensaje
include __DIR__ . '/../views/llistar_iniciar_sesion.php';
?>
