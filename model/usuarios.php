<?php

function registrar($connection, $nombre, $password, $email, $rol, $pregunta_seguridad, $respuesta_seguridad) {
    try {
        // Debug: Imprimir los valores que se intentan insertar
        error_log("Intentando insertar usuario con los siguientes datos:");
        error_log("Nombre: " . $nombre);
        error_log("Email: " . $email);
        error_log("Rol: " . $rol);

        $sql = "INSERT INTO usuarios (nombre, password, email, rol, pregunta_seguridad, respuesta_seguridad) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        $consulta = $connection->prepare($sql);
        
        $resultado = $consulta->execute([
            $nombre,
            $password,
            $email,
            $rol,
            $pregunta_seguridad,
            $respuesta_seguridad
        ]);

        if ($resultado) {
            error_log("Usuario registrado exitosamente con ID: " . $connection->lastInsertId());
            return true;
        } else {
            error_log("Error en la inserción: " . print_r($consulta->errorInfo(), true));
            return false;
        }
    } catch (PDOException $e) {
        error_log("Error PDO en registro: " . $e->getMessage());
        throw $e;
    }
}

function obtenerUsuarioPorEmail($connection, $email) {
    try {
        $consulta = $connection->prepare("SELECT id, nombre, email, password, rol, pregunta_seguridad, respuesta_seguridad FROM usuarios WHERE email = ?");
        $consulta->execute([$email]);
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
        
        error_log("Búsqueda de usuario - Email: " . $email);
        if ($usuario) {
            error_log("Usuario encontrado - Nombre: " . $usuario['nombre'] . ", Rol: " . $usuario['rol']);
        } else {
            error_log("Usuario no encontrado");
        }
        
        return $usuario;
    } catch (PDOException $e) {
        error_log("Error en obtenerUsuarioPorEmail: " . $e->getMessage());
        return false;
    }
}

function actualizarPassword($connection, $email, $nuevo_password) {
    try {
        $consulta = $connection->prepare("UPDATE usuarios SET password = ? WHERE email = ?");
        return $consulta->execute([$nuevo_password, $email]);
    } catch (PDOException $e) {
        error_log("Error actualizando password: " . $e->getMessage());
        return false;
    }
}

function emailExiste($connection, $email) {
    try {
        $consulta = $connection->prepare("SELECT COUNT(*) FROM usuarios WHERE email = ?");
        $consulta->execute([$email]);
        return $consulta->fetchColumn() > 0;
    } catch (PDOException $e) {
        error_log("Error verificando email: " . $e->getMessage());
        return false;
    }
}

function contarUsuarios($connection) {
    try {
        $consulta = $connection->query("SELECT COUNT(*) FROM usuarios");
        return $consulta->fetchColumn();
    } catch (PDOException $e) {
        error_log("Error contando usuarios: " . $e->getMessage());
        return 0;
    }
}

function contarProductos($connection) {
    try {
        $consulta = $connection->query("SELECT COUNT(*) FROM productos");
        return $consulta->fetchColumn();
    } catch (PDOException $e) {
        error_log("Error contando productos: " . $e->getMessage());
        return 0;
    }
}

function contarCategorias($connection) {
    try {
        $consulta = $connection->query("SELECT COUNT(*) FROM categorias");
        return $consulta->fetchColumn();
    } catch (PDOException $e) {
        error_log("Error contando categorías: " . $e->getMessage());
        return 0;
    }
}

?>