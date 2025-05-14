<?php
// resource_perfil.php
// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar que el usuario esté autenticado
if (!isset($_SESSION['usuario'])) {
    header('Location: ?action=inicio-session');
    exit();
}

// Incluir el modelo de usuarios
require_once __DIR__ . '/model/connectaDB.php';

// Inicializar variables
$connection = DB::getInstance();
$mensaje = '';
$error = '';
$usuario = [];

// Obtener datos del usuario actual
try {
    $consulta = $connection->prepare("SELECT * FROM usuarios WHERE email = ? OR nombre = ?");
    $consulta->execute([$_SESSION['usuario'], $_SESSION['usuario']]);
    $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
    
    if (!$usuario) {
        // Si no se encuentra el usuario, redirigir al inicio
        header('Location: ?action=portada');
        exit();
    }
} catch (PDOException $e) {
    $error = "Error al obtener datos del usuario: " . $e->getMessage();
}

// Procesar formulario de actualización de perfil
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar_perfil'])) {
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    
    // Validaciones básicas
    if (empty($nombre)) {
        $error = "El nombre es obligatorio";
    } elseif (empty($email)) {
        $error = "El email es obligatorio";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "El formato del email no es válido";
    } else {
        try {
            // Verificar si el email ya existe (excepto para el usuario actual)
            $consulta = $connection->prepare("SELECT id FROM usuarios WHERE email = ? AND id != ?");
            $consulta->execute([$email, $usuario['id']]);
            $existe = $consulta->fetch();
            
            if ($existe) {
                $error = "Este email ya está registrado por otro usuario";
            } else {
                // Actualizar perfil
                $consulta = $connection->prepare("UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?");
                $resultado = $consulta->execute([$nombre, $email, $usuario['id']]);
                
                if ($resultado) {
                    $mensaje = "Perfil actualizado correctamente";
                    // Actualizar la sesión con el nuevo nombre/email
                    $_SESSION['usuario'] = $email;
                    // Recargar datos del usuario
                    $consulta = $connection->prepare("SELECT * FROM usuarios WHERE id = ?");
                    $consulta->execute([$usuario['id']]);
                    $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
                } else {
                    $error = "Error al actualizar el perfil";
                }
            }
        } catch (PDOException $e) {
            $error = "Error en la base de datos: " . $e->getMessage();
        }
    }
}

// Procesar formulario de cambio de contraseña
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cambiar_password'])) {
    $password_actual = $_POST['current_password'] ?? '';
    $password_nueva = $_POST['new_password'] ?? '';
    $password_confirmar = $_POST['confirm_password'] ?? '';
    
    // Validaciones básicas
    if (empty($password_actual) || empty($password_nueva) || empty($password_confirmar)) {
        $error = "Todos los campos de contraseña son obligatorios";
    } elseif ($password_nueva !== $password_confirmar) {
        $error = "Las contraseñas nuevas no coinciden";
    } elseif (strlen($password_nueva) < 6) {
        $error = "La contraseña debe tener al menos 6 caracteres";
    } else {
        try {
            // Verificar contraseña actual
            if (password_verify($password_actual, $usuario['password']) || $password_actual === $usuario['password']) {
                // Encriptar nueva contraseña
                $password_hash = password_hash($password_nueva, PASSWORD_DEFAULT);
                
                // Actualizar contraseña
                $consulta = $connection->prepare("UPDATE usuarios SET password = ? WHERE id = ?");
                $resultado = $consulta->execute([$password_hash, $usuario['id']]);
                
                if ($resultado) {
                    $mensaje = "Contraseña actualizada correctamente";
                } else {
                    $error = "Error al actualizar la contraseña";
                }
            } else {
                $error = "La contraseña actual es incorrecta";
            }
        } catch (PDOException $e) {
            $error = "Error en la base de datos: " . $e->getMessage();
        }
    }
}

// Incluir la vista del header
include __DIR__ . '/views/header_usuario.php';

// Incluir la vista del perfil
include __DIR__ . '/views/perfil.php';

// Incluir la vista del footer
include __DIR__ . '/views/footer.php';
?>
