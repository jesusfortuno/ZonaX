<?php

function getProductos($conection) {
    try {
        // Consulta parametrizada para evitar inyecciones SQL
        $sql = "SELECT id_producto, nombre_producto, descripción, coste, id_categoria, imagen FROM PRODUCTOS";
        $stmt = $conection->prepare($sql);
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Verificar si hay resultados
        if (empty($resultat)) {
            error_log("No se encontraron productos en la base de datos");
        }
        
        // Asegurarse de que cada producto tenga un campo 'id' para compatibilidad
        foreach ($resultat as &$producto) {
            if (!isset($producto['id']) && isset($producto['id_producto'])) {
                $producto['id'] = $producto['id_producto'];
            }
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

/**
 * Función auxiliar para obtener productos (para compatibilidad)
 * @return array Arreglo con todos los productos
 */
function obtenerProductos() {
    // Productos de ejemplo
    return [
        [
            'id' => 1,
            'nombre_producto' => 'Morgan 2',
            'descripción' => 'Estimula la zona G y el clítoris con este vibrador de doble función.',
            'coste' => 59.99,
            'id_categoria' => 1,
            'imagen' => 'img/morgan2.jpg'
        ],
        [
            'id' => 2,
            'nombre_producto' => 'SENSEI masturbador para pene',
            'descripción' => 'Sensei es un masturbador de pene reutilizable con textura interior estimulante.',
            'coste' => 50.00,
            'id_categoria' => 2,
            'imagen' => 'img/sensei.jpg'
        ],
        [
            'id' => 3,
            'nombre_producto' => 'Juguete sexual para parejas Mobi PlatanoMelón',
            'descripción' => 'Mobi es un juguete todoterreno con control remoto para disfrutar en pareja.',
            'coste' => 70.00,
            'id_categoria' => 3,
            'imagen' => 'img/mobi.jpg'
        ],
        [
            'id' => 4,
            'nombre_producto' => 'PLAY EFECTO CALOR Y FRÍO lubricante íntimo',
            'descripción' => 'PLAY EFECTO CALOR Y FRÍO lubricante íntimo de DUREX con sensaciones térmicas.',
            'coste' => 10.00,
            'id_categoria' => 4,
            'imagen' => 'img/play.jpg'
        ],
        [
            'id' => 5,
            'nombre_producto' => 'SENSITIVO SUAVE preservativos',
            'descripción' => 'SENSITIVO SUAVE preservativos de DUREX para una sensación natural.',
            'coste' => 20.00,
            'id_categoria' => 5,
            'imagen' => 'img/sensitivo.jpg'
        ],
        [
            'id' => 6,
            'nombre_producto' => 'Camiseta lisa puntilla',
            'descripción' => 'Camiseta básica lisa con detalle de encaje en escote y tirantes.',
            'coste' => 10.00,
            'id_categoria' => 6,
            'imagen' => 'img/camiseta.jpg'
        ],
        [
            'id' => 7,
            'nombre_producto' => 'Esposas sexuales, esposas de tobillo, Kit de Bondage',
            'descripción' => 'Kit completo de accesorios BDSM para principiantes y experimentados.',
            'coste' => 35.00,
            'id_categoria' => 7,
            'imagen' => 'img/esposas.jpg'
        ],
        [
            'id' => 8,
            'nombre_producto' => 'Vibrador Rabbit Deluxe',
            'descripción' => 'Vibrador con doble estimulación y múltiples velocidades para un placer intenso.',
            'coste' => 65.99,
            'id_categoria' => 1,
            'imagen' => 'img/rabbit.jpg'
        ]
    ];
}
?>
