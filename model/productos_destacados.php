<?php

/**
 * Obtiene los productos destacados de la base de datos
 * 
 * @param PDO $conection Conexión a la base de datos
 * @param int $limit Número máximo de productos a obtener
 * @return array Array con los productos destacados
 */
function getProductosDestacados($conection, $limit = 3) {
    try {
        // Consulta para obtener productos destacados
        // Puedes modificar esta consulta según tu estructura de base de datos
        // Por ejemplo, puedes tener un campo 'destacado' o seleccionar los más vendidos
        $sql = "SELECT id_producto as id, nombre_producto, descripción, coste, id_categoria, imagen 
                FROM PRODUCTOS 
                ORDER BY RAND() 
                LIMIT :limit";
                
        $stmt = $conection->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Verificar si hay resultados
        if (empty($productos)) {
            error_log("No se encontraron productos destacados");
        } else {
            error_log("Número de productos destacados obtenidos: " . count($productos));
        }
        
        return $productos;
    } catch (PDOException $e) {
        error_log("Error en getProductosDestacados: " . $e->getMessage());
        return [];
    }
}

/**
 * Obtiene los productos más vendidos
 * 
 * @param PDO $conection Conexión a la base de datos
 * @param int $limit Número máximo de productos a obtener
 * @return array Array con los productos más vendidos
 */
function getProductosMasVendidos($conection, $limit = 3) {
    try {
        // Esta es una consulta de ejemplo. Deberías adaptarla a tu estructura de base de datos
        // Idealmente tendrías una tabla de ventas o pedidos para determinar los más vendidos
        $sql = "SELECT p.id_producto as id, p.nombre_producto, p.descripción, p.coste, p.id_categoria, p.imagen 
                FROM PRODUCTOS p
                ORDER BY RAND() 
                LIMIT :limit";
                
        $stmt = $conection->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error en getProductosMasVendidos: " . $e->getMessage());
        return [];
    }
}

/**
 * Obtiene los productos más recientes
 * 
 * @param PDO $conection Conexión a la base de datos
 * @param int $limit Número máximo de productos a obtener
 * @return array Array con los productos más recientes
 */
function getProductosRecientes($conection, $limit = 3) {
    try {
        // Esta consulta asume que tienes un campo fecha_creacion o similar
        // Ajústala según tu estructura de base de datos
        $sql = "SELECT id_producto as id, nombre_producto, descripción, coste, id_categoria, imagen 
                FROM PRODUCTOS 
                ORDER BY id_producto DESC 
                LIMIT :limit";
                
        $stmt = $conection->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error en getProductosRecientes: " . $e->getMessage());
        return [];
    }
}
?>
