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

function obtenerUsuarioPorNombre($connection, $nombre) {
   try {
       $consulta = $connection->prepare("SELECT id, nombre, email, password, rol, pregunta_seguridad, respuesta_seguridad FROM usuarios WHERE nombre = ?");
       $consulta->execute([$nombre]);
       $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
       
       error_log("Búsqueda de usuario - Nombre: " . $nombre);
       if ($usuario) {
           error_log("Usuario encontrado - Email: " . $usuario['email'] . ", Rol: " . $usuario['rol']);
       } else {
           error_log("Usuario no encontrado");
       }
       
       return $usuario;
   } catch (PDOException $e) {
       error_log("Error en obtenerUsuarioPorNombre: " . $e->getMessage());
       return false;
   }
}

function actualizarPassword($connection, $email, $nuevo_password) {
   try {
       error_log("Actualizando contraseña para el usuario con email: " . $email);
       $consulta = $connection->prepare("UPDATE usuarios SET password = ? WHERE email = ?");
       $resultado = $consulta->execute([$nuevo_password, $email]);
       
       if ($resultado) {
           error_log("Contraseña actualizada correctamente");
       } else {
           error_log("Error al actualizar contraseña: " . print_r($consulta->errorInfo(), true));
       }
       
       return $resultado;
   } catch (PDOException $e) {
       error_log("Error PDO actualizando password: " . $e->getMessage());
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

// La función contarCategorias() ha sido eliminada de este archivo
// Ahora se encuentra en model/categories.php

function actualizarPerfilUsuario($connection, $id, $nombre, $email) {
   try {
       error_log("Actualizando perfil para el usuario con ID: " . $id);
       error_log("Nuevo nombre: " . $nombre);
       error_log("Nuevo email: " . $email);
       
       $consulta = $connection->prepare("UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?");
       $resultado = $consulta->execute([$nombre, $email, $id]);
       
       if ($resultado) {
           error_log("Perfil actualizado correctamente");
       } else {
           error_log("Error al actualizar perfil: " . print_r($consulta->errorInfo(), true));
       }
       
       return $resultado;
   } catch (PDOException $e) {
       error_log("Error PDO en actualizarPerfilUsuario: " . $e->getMessage());
       return false;
   }
}

?>
