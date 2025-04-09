<?php

function getProductos($conection) {
    try {
        // Consulta parametrizada para evitar inyecciones SQL
        $sql = "SELECT id_producto as id, nombre_producto, descripción, coste, id_categoria, imagen FROM PRODUCTOS";
        $stmt = $conection->prepare($sql);
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Verificar si hay resultados
        if (empty($resultat)) {
            error_log("No se encontraron productos en la base de datos");
        }
        
        return $resultat;
    } catch (PDOException $e) {
        error_log("Error en getProductos: " . $e->getMessage());
        return [];
    }
}

// Nueva función para obtener productos por categoría
function getProductosByCategoria($conection, $id_categoria) {
    try {
        $sql = "SELECT id_producto as id, nombre_producto, descripción, coste, id_categoria, imagen FROM PRODUCTOS WHERE id_categoria = :id_categoria";
        $stmt = $conection->prepare($sql);
        $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error en getProductosByCategoria: " . $e->getMessage());
        return [];
    }
}

// Nueva función para añadir un producto
function addProducto($conection, $nombre_producto, $descripcion, $coste, $id_categoria, $ruta_imagen) {
    try {
        $sql = "INSERT INTO PRODUCTOS (nombre_producto, descripción, coste, id_categoria, imagen) VALUES (:nombre_producto, :descripcion, :coste, :id_categoria, :imagen)";
        $stmt = $conection->prepare($sql);
        $stmt->bindParam(':nombre_producto', $nombre_producto);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':coste', $coste);
        $stmt->bindParam(':id_categoria', $id_categoria);
        $stmt->bindParam(':imagen', $ruta_imagen);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        error_log("Error en addProducto: " . $e->getMessage());
        return false;
    }
}

// Nueva función para editar un producto
function editProducto($conection, $id_producto, $nombre_producto, $descripcion, $coste, $id_categoria, $ruta_imagen) {
    try {
        $sql = "UPDATE PRODUCTOS SET nombre_producto = :nombre_producto, descripción = :descripcion, coste = :coste, id_categoria = :id_categoria, imagen = :imagen WHERE id_producto = :id_producto";
        $stmt = $conection->prepare($sql);
        $stmt->bindParam(':id_producto', $id_producto);
        $stmt->bindParam(':nombre_producto', $nombre_producto);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':coste', $coste);
        $stmt->bindParam(':id_categoria', $id_categoria);
        $stmt->bindParam(':imagen', $ruta_imagen);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        error_log("Error en editProducto: " . $e->getMessage());
        return false;
    }
}

// Nueva función para eliminar un producto
function deleteProducto($conection, $id_producto) {
    try {
        $sql = "DELETE FROM PRODUCTOS WHERE id_producto = :id_producto";
        $stmt = $conection->prepare($sql);
        $stmt->bindParam(':id_producto', $id_producto);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        error_log("Error en deleteProducto: " . $e->getMessage());
        return false;
    }
}

function getProductoById($conection, $id_producto) {
    try {
        $sql = "SELECT id_producto as id, nombre_producto, descripción, coste, id_categoria, imagen FROM PRODUCTOS WHERE id_producto = :id_producto";
        $stmt = $conection->prepare($sql);
        $stmt->bindParam(':id_producto', $id_producto);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error en getProductoById: " . $e->getMessage());
        return null;
    }
}
?>
