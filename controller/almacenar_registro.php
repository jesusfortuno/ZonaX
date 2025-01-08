<?php 

require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/usuarios.php';

$errors = [];

// Validar nombre
if (empty($_POST['nombre']) || strlen($_POST['nombre']) < 4 || strlen($_POST['nombre']) > 20) {
    $errors[] = "El nombre de usuario debe tener entre 4 y 20 caracteres.";
}

// Validar email
if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = "El correo electrónico debe tener un formato válido.";
}

// Validar contraseña
if (empty($_POST['contraseña']) || strlen($_POST['contraseña']) < 4 || strlen($_POST['contraseña']) > 20) {
    $errors[] = "La contraseña debe tener entre 4 y 20 caracteres.";
}

// Si no hay errores, guardar los datos en la base de datos
if (empty($errors)) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT); // Encriptar contraseña

    $connection = DB::getInstance();
    $registre = registrar($connection, $nombre, $email, $contraseña);

    if ($registre) {
        $mensaje = "Registro correcto";
        $usuario = obtenerUsuarioPorNombre($connection, $nombre); // Obtener datos del usuario registrado
    } else {
        $mensaje = "Error en el registro";
    }

    include __DIR__ . '/../views/llistar_registre.php';
} else {
    // Si hay errores, los mostramos en la vista
    include __DIR__ . '/../views/llistar_registre.php';
}

?>