<?php

function getProductos($conection) {
    try {
        // Consulta parametrizada para evitar inyecciones SQL
        $sql = "SELECT id_producto, nombre_producto, descripción, coste, id_categoria, imagen FROM PRODUCTOS";
        $stmt = $conection->prepare($sql);
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error: " . $e->getMessage());
        $resultat = [];
    }

    return $resultat;
}

// Nueva función para obtener productos por categoría
function getProductosByCategoria($conection, $id_categoria) {
    $productos = getProductos($conection); // Obtener todos los productos
    // Filtrar productos por id_categoria
    return array_filter($productos, function($producto) use ($id_categoria) {
        return $producto['id_categoria'] == $id_categoria;
    });
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
    } catch (PDOException $e) {
        error_log("Error: " . $e->getMessage());
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
    } catch (PDOException $e) {
        error_log("Error: " . $e->getMessage());
    }
}

// Nueva función para eliminar un producto
function deleteProducto($conection, $id_producto) {
    try {
        $sql = "DELETE FROM PRODUCTOS WHERE id_producto = :id_producto";
        $stmt = $conection->prepare($sql);
        $stmt->bindParam(':id_producto', $id_producto);
        $stmt->execute();
    } catch (PDOException $e) {
        error_log("Error: " . $e->getMessage());
    }
}

function getProductoById($conection, $id_producto) {
    try {
        $sql = "SELECT * FROM PRODUCTOS WHERE id_producto = :id_producto";
        $stmt = $conection->prepare($sql);
        $stmt->bindParam(':id_producto', $id_producto);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error: " . $e->getMessage());
        return null;
    }
}
?>