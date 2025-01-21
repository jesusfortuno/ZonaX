<?php
require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/usuarios.php';

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $respuesta = $_POST['respuesta_seguridad'] ?? '';
    $nueva_contraseña = $_POST['nueva_contraseña'] ?? '';
    
    $connection = DB::getInstance();
    $usuario = obtenerUsuarioPorEmail($connection, $email);
    
    if ($usuario && password_verify($respuesta, $usuario['respuesta_seguridad'])) {
        $nueva_contraseña_hash = password_hash($nueva_contraseña, PASSWORD_DEFAULT);
        // Cambiado actualizarContraseña por actualizarPassword
        if (actualizarPassword($connection, $email, $nueva_contraseña_hash)) {
            $success = true;
        } else {
            $errors['general'] = "Error al actualizar la contraseña.";
        }
    } else {
        $errors['general'] = "Email o respuesta de seguridad incorrectos.";
    }
}

include __DIR__ . '/../views/recuperar_password.php';
?>