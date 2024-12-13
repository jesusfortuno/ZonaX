<?php 

require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/usuarios.php';

$errors = [];

// Validar username
if (empty($_POST['username']) || strlen($_POST['username']) < 4 || strlen($_POST['username']) > 20) {
    $errors[] = "El nombre de usuario debe tener entre 4 y 20 caracteres.";
}

// Validar password
if (empty($_POST['password']) || strlen($_POST['password']) < 4 || strlen($_POST['password']) > 20) {
    $errors[] = "La contraseña debe tener entre 4 y 20 caracteres.";
}

// Validar first_name
if (empty($_POST['first_name']) || strlen($_POST['first_name']) < 4 || strlen($_POST['first_name']) > 20) {
    $errors[] = "El nombre debe tener entre 4 y 20 caracteres.";
}

// Validar email
if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = "El correo electrónico debe tener un formato válido.";
}

// Validar postal
if (empty($_POST['postal']) || !ctype_digit($_POST['postal']) || strlen($_POST['postal']) !== 5) {
    $errors[] = "El código postal debe ser numérico y tener exactamente 5 caracteres.";
}

// Si no hay errores, guardar los datos en $_SESSION
if (empty($errors)) {
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];
    $_SESSION['first_name'] = $_POST['first_name'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['postal'] = $_POST['postal'];

    // Corregido aquí
    $password = password_hash($_SESSION['password'], PASSWORD_DEFAULT);
    
    $connection = DB::getInstance();
    $registre = registrar($connection, $_SESSION['username'], $password);

    if ($registre) {
        $mensaje = "Registro correcto";
    } else {
        $mensaje = "Error en el registro";
    }

    include __DIR__ . '/../views/llistar_registre.php';
} else {
    // Si hay errores, los mostramos en la vista
    include __DIR__ . '/../views/llistar_registre.php';
}
?>

