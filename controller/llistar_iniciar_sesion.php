<?php
require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/usuarios.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $connection = DB::getInstance();
    $usuario = obtenerUsuarioPorEmail($connection, $email);
    
    // Debug
    error_log("Intento de login - Email: " . $email);
    if ($usuario) {
        error_log("Usuario encontrado - Rol: " . $usuario['rol']);
    }
    
    if ($usuario && password_verify($password, $usuario['password'])) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['usuario'] = $usuario['nombre'];
        $_SESSION['rol'] = $usuario['rol'];
        
        error_log("Login exitoso - Usuario: " . $_SESSION['usuario'] . ", Rol: " . $_SESSION['rol']);
        
        if ($_SESSION['rol'] === 'admin') {
            error_log("Redirigiendo a dashboard");
            header('Location: ?action=dashboard');
        } else {
            error_log("Redirigiendo a portada");
            header('Location: ?action=portada');
        }
        exit();
    } else {
        error_log("Login fallido - Contraseña incorrecta o usuario no encontrado");
        $error = "Credenciales incorrectas";
        include __DIR__ . '/../resource_portada.php';
    }
}
?>