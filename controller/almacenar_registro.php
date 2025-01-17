<?php

require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/usuarios.php';

$errors = [];
$connection = DB::getInstance(); // Conexión a la base de datos

// Validar nombre
if (empty($_POST['nombre']) || strlen($_POST['nombre']) < 4 || strlen($_POST['nombre']) > 20) {
    $errors['nombre'] = "El nombre de usuario debe tener entre 4 y 20 caracteres.";
} elseif (nombreExiste($connection, $_POST['nombre'])) {
    $errors['nombre'] = "El nombre de usuario ya está en uso.";
}

// Validar contraseña
if (empty($_POST['contraseña']) || strlen($_POST['contraseña']) < 4 || strlen($_POST['contraseña']) > 20) {
    $errors['contraseña'] = "La contraseña debe tener entre 4 y 20 caracteres.";
}

// Validar email
if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "El correo electrónico debe tener un formato válido.";
} elseif (emailExiste($connection, $_POST['email'])) {
    $errors['email'] = "El correo electrónico ya está en uso.";
}

// Si no hay errores, registrar al usuario
if (empty($errors)) {
    $nombre = $_POST['nombre'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    if (registrar($connection, $nombre, $contraseña, $email)) {
        session_start();
        $_SESSION['usuario'] = $nombre; // Guardar usuario en sesión
        header("Location: ?action=a"); // Redirigir a la portada
        exit();
    } else {
        $errors['general'] = "Error en el registro. Por favor, inténtalo de nuevo.";
    }
}

include __DIR__ . '/../views/llistar_registre.php';
?>
