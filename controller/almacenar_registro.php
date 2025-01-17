<?php

require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/usuarios.php';

$errors = [];
$connection = DB::getInstance(); // Conexión a la base de datos

// Validar nombre
if (empty($_POST['nombre']) || strlen($_POST['nombre']) < 4 || strlen($_POST['nombre']) > 20) {
    $errors['nombre'] = "El nombre de usuario debe tener entre 4 y 20 caracteres.";
}

// Validar contraseña
if (empty($_POST['contraseña']) || strlen($_POST['contraseña']) < 4 || strlen($_POST['contraseña']) > 20) {
    $errors['contraseña'] = "La contraseña debe tener entre 4 y 20 caracteres.";
}

// Validar email
if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "El correo electrónico debe tener un formato válido.";
}

// Si no hay errores, proceder
if (empty($errors)) {
    $nombre = $_POST['nombre'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $rol = isset($_POST['rol']) && $_POST['rol'] === 'admin' ? 'admin' : 'usuario'; // Determinar rol

    // Verificar si el usuario o el correo ya existen
    $usuarioExistente = obtenerUsuarioPorNombreOEmail($connection, $nombre, $email);

    if ($usuarioExistente) {
        if ($usuarioExistente['rol'] === 'admin') {
            // Si el usuario existente es un administrador, redirigir al formulario de inicio de sesión
            $errors['general'] = "Este usuario o email pertenece a un administrador. Por favor, inicia sesión.";
            header("Location: ?action=login");
            exit();
        } else {
            // Si el usuario existente es un usuario normal
            $errors['general'] = "El nombre de usuario o correo electrónico ya está en uso. Por favor, elige otros.";
        }
    } else {
        // Registrar al nuevo usuario
        $resultado = registrar($connection, $nombre, $contraseña, $email, $rol);

        if ($resultado) {
            session_start();
            $_SESSION['usuario'] = $nombre;
            $_SESSION['rol'] = $rol;

            if ($rol === 'admin') {
                header("Location: ?action=admin"); // Redirigir al panel admin
            } else {
                header("Location: ?action=usuario"); // Redirigir al panel usuario
            }
            exit();
        } else {
            $errors['general'] = "Error en el registro. Por favor, inténtalo de nuevo.";
        }
    }
}

include __DIR__ . '/../views/llistar_registre.php';

?>
