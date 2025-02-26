<?php

function getProductos($conection) {
    try {
        // Consulta parametrizada para evitar inyecciones SQL
        $sql = "SELECT id_producto, nombre_producto, descripción, coste, id_categoria FROM PRODUCTOS";
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
function addProducto($conection, $nombre_producto, $descripcion, $coste, $id_categoria) {
    try {
        $sql = "INSERT INTO PRODUCTOS (nombre_producto, descripción, coste, id_categoria) VALUES (:nombre_producto, :descripcion, :coste, :id_categoria)";
        $stmt = $conection->prepare($sql);
        $stmt->bindParam(':nombre_producto', $nombre_producto);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':coste', $coste);
        $stmt->bindParam(':id_categoria', $id_categoria);
        $stmt->execute();
    } catch (PDOException $e) {
        error_log("Error: " . $e->getMessage());
    }
}

// Nueva función para editar un producto
function editProducto($conection, $id_producto, $nombre_producto, $descripcion, $coste, $id_categoria) {
    try {
        $sql = "UPDATE PRODUCTOS SET nombre_producto = :nombre_producto, descripción = :descripcion, coste = :coste, id_categoria = :id_categoria WHERE id_producto = :id_producto";
        $stmt = $conection->prepare($sql);
        $stmt->bindParam(':id_producto', $id_producto);
        $stmt->bindParam(':nombre_producto', $nombre_producto);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':coste', $coste);
        $stmt->bindParam(':id_categoria', $id_categoria);
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
?>