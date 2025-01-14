<?php 

require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/usuarios.php';

$errors = [];

// Validar nombre
if (empty($_POST['nombre']) || strlen($_POST['nombre']) < 4 || strlen($_POST['nombre']) > 20) {
    $errors[] = "El nombre de usuario debe tener entre 4 y 20 caracteres.";
}

// Validar contraseña
if (empty($_POST['contraseña']) || strlen($_POST['contraseña']) < 4 || strlen($_POST['contraseña']) > 20) {
    $errors[] = "La contraseña debe tener entre 4 y 20 caracteres.";
}

// Validar email
if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = "El correo electrónico debe tener un formato válido.";
} else {
    // Verificar si el email ya existe para el rol correspondiente
    $connection = DB::getInstance();
    $rol = $_POST['rol'] ?? 'usuario'; // Por defecto, usuario
    if (emailExiste($connection, $_POST['email'], $rol)) {
        $errors[] = "El correo electrónico ya está en uso para este rol.";
    }
}

// Si no hay errores, registrar al usuario
if (empty($errors)) {
    $nombre = $_POST['nombre'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $rol = $_POST['rol'] ?? 'usuario'; // Asignar el rol desde el formulario o por defecto

    $registre = registrar($connection, $nombre, $contraseña, $email, $rol);

    if ($registre) {
        $mensaje = "Registro correcto";
    } else {
        $mensaje = "Error en el registro";
    }

    include __DIR__ . '/../views/llistar_registre.php';
} else {
    include __DIR__ . '/../views/llistar_registre.php';
}

?>