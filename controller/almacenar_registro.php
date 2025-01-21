<?php
require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/usuarios.php';

// Activar la visualización de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

$errors = [];
$connection = DB::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar email
    $email = trim($_POST['email'] ?? '');
    if (empty($email)) {
        $errors['email'] = "El email es obligatorio.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "El formato del email no es válido.";
    } elseif (emailExiste($connection, $email)) {
        $errors['email'] = "Este email ya está registrado.";
    }

    // Validar nombre
    $nombre = trim($_POST['nombre'] ?? '');
    if (empty($nombre)) {
        $errors['nombre'] = "El nombre es obligatorio.";
    }

    // Validar password
    $password = $_POST['password'] ?? '';
    if (empty($password)) {
        $errors['password'] = "La contraseña es obligatoria.";
    }

    // Validar pregunta y respuesta de seguridad
    $pregunta_seguridad = $_POST['pregunta_seguridad'] ?? '';
    $respuesta_seguridad = $_POST['respuesta_seguridad'] ?? '';
    if (empty($pregunta_seguridad) || empty($respuesta_seguridad)) {
        $errors['seguridad'] = "La pregunta y respuesta de seguridad son obligatorias.";
    }

    if (empty($errors)) {
        try {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $respuesta_hash = password_hash($respuesta_seguridad, PASSWORD_DEFAULT);
            
            $resultado = registrar(
                $connection,
                $nombre,
                $password_hash,
                $email,
                'usuario',
                $pregunta_seguridad,
                $respuesta_hash
            );

            if ($resultado) {
                session_start();
                $_SESSION['usuario'] = $nombre;
                $_SESSION['rol'] = 'usuario';
                header("Location: ?action=portada");
                exit();
            } else {
                $errors['general'] = "Error en el registro.";
            }
        } catch (PDOException $e) {
            if ($e->getCode() == '23000') { // Error de duplicado
                $errors['email'] = "Este email ya está registrado.";
            } else {
                error_log("Error en registro: " . $e->getMessage());
                $errors['general'] = "Error en el registro. Por favor, inténtalo de nuevo.";
            }
        }
    }
}

include __DIR__ . '/../views/llistar_registre.php';

?>