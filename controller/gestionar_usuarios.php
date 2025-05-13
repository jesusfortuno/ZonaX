<?php
require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/usuarios.php';

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header('Location: ?action=portada');
    exit();
}

$conexion = DB::getInstance();
$mensaje = '';
$error = '';

// Función para obtener todos los usuarios
function getUsuarios($conexion) {
    try {
        $consulta = $conexion->prepare("SELECT id, nombre, email, rol FROM usuarios");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error al obtener usuarios: " . $e->getMessage());
        return [];
    }
}

// Función para obtener un usuario por ID
function getUsuarioPorId($conexion, $id) {
    try {
        $consulta = $conexion->prepare("SELECT id, nombre, email, rol FROM usuarios WHERE id = ?");
        $consulta->execute([$id]);
        return $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error al obtener usuario por ID: " . $e->getMessage());
        return null;
    }
}

// Función para actualizar un usuario
function actualizarUsuario($conexion, $id, $nombre, $email, $rol) {
    try {
        $consulta = $conexion->prepare("UPDATE usuarios SET nombre = ?, email = ?, rol = ? WHERE id = ?");
        return $consulta->execute([$nombre, $email, $rol, $id]);
    } catch (PDOException $e) {
        error_log("Error al actualizar usuario: " . $e->getMessage());
        return false;
    }
}

// Función para eliminar un usuario
function eliminarUsuario($conexion, $id) {
    try {
        $consulta = $conexion->prepare("DELETE FROM usuarios WHERE id = ?");
        return $consulta->execute([$id]);
    } catch (PDOException $e) {
        error_log("Error al eliminar usuario: " . $e->getMessage());
        return false;
    }
}

// Procesar formularios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';

    switch ($accion) {
        case 'edit':
            $id = $_POST['id'] ?? '';
            $nombre = trim($_POST['nombre'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $rol = $_POST['rol'] ?? 'usuario';

            if (!empty($id) && !empty($nombre) && !empty($email)) {
                if (actualizarUsuario($conexion, $id, $nombre, $email, $rol)) {
                    $mensaje = "Usuario actualizado correctamente.";
                } else {
                    $error = "Error al actualizar el usuario.";
                }
            } else {
                $error = "Todos los campos son obligatorios.";
            }
            break;

        case 'delete':
            $id = $_POST['id'] ?? '';
            if (!empty($id)) {
                if (eliminarUsuario($conexion, $id)) {
                    $mensaje = "Usuario eliminado correctamente.";
                } else {
                    $error = "Error al eliminar el usuario.";
                }
            } else {
                $error = "ID de usuario no válido.";
            }
            break;
    }
}

// Obtener la lista de usuarios
$usuarios = getUsuarios($conexion);

// Incluir la vista
include __DIR__ . '/../views/gestionar_usuarios.php';
?>
