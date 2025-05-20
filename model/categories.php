<?php
/**
 * Obtiene todas las categorías de la base de datos
 * @param PDO $conection Conexión a la base de datos
 * @return array Array con todas las categorías
 */
function getAllCategories($conection) {
    try {
        $consulta = $conection->prepare("SELECT id_categoria as id, nombre_categoria, descripcion FROM CATEGORIA");
        $consulta->execute();
        $categorias = $consulta->fetchAll(PDO::FETCH_ASSOC);
        
        // Si no hay categorías, crear algunas de ejemplo
        if (empty($categorias)) {
            $categorias = [
                [
                    'id' => 1,
                    'nombre_categoria' => 'Vibradores Mujer',
                    'descripcion' => 'Explora nuestra selección de vibradores para mujer.',
                    'imagen' => 'img/vibrador-mujer.png'
                ],
                [
                    'id' => 2,
                    'nombre_categoria' => 'Vibradores Hombre',
                    'descripcion' => 'Descubre nuestra colección de vibradores para hombre.',
                    'imagen' => 'img/vibrador-hombre.png'
                ],
                [
                    'id' => 3,
                    'nombre_categoria' => 'Juguetes para Parejas',
                    'descripcion' => 'Encuentra juguetes diseñados para disfrutar en pareja.',
                    'imagen' => 'img/jueguete-pareja.png'
                ],
                [
                    'id' => 4,
                    'nombre_categoria' => 'Lubricantes',
                    'descripcion' => 'Amplia variedad de lubricantes para mejorar tu experiencia.',
                    'imagen' => 'img/lubricantes.png'
                ],
                [
                    'id' => 6,
                    'nombre_categoria' => 'Lencería',
                    'descripcion' => 'Lencería sensual para todas las ocasiones.',
                    'imagen' => 'img/lenceria.png'
                ],
                [
                    'id' => 7,
                    'nombre_categoria' => 'BDSM',
                    'descripcion' => 'Accesorios y juguetes para experiencias BDSM.',
                    'imagen' => 'img/bdsm.png'
                ]
            ];
        }
        
        return $categorias;
    } catch(PDOException $e) {
        error_log("Error en getAllCategories: " . $e->getMessage());
        return [];
    }
}

/**
 * Obtiene una categoría por su ID
 * @param PDO $conection Conexión a la base de datos
 * @param int $id_categoria ID de la categoría
 * @return array|null Datos de la categoría o null si no existe
 */
function getCategoryById($conection, $id_categoria) {
    try {
        $consulta = $conection->prepare("SELECT id_categoria as id, nombre_categoria, descripcion FROM CATEGORIA WHERE id_categoria = :id");
        $consulta->bindParam(':id', $id_categoria, PDO::PARAM_INT);
        $consulta->execute();
        $categoria = $consulta->fetch(PDO::FETCH_ASSOC);
        
        // Si no se encuentra la categoría, buscar en las categorías de ejemplo
        if (!$categoria) {
            $categorias = getAllCategories($conection);
            foreach ($categorias as $cat) {
                if ($cat['id'] == $id_categoria) {
                    return $cat;
                }
            }
            return null;
        }
        
        return $categoria;
    } catch(PDOException $e) {
        error_log("Error en getCategoryById: " . $e->getMessage());
        return null;
    }
}

/**
 * Cuenta el número total de categorías en la base de datos
 * @param PDO $conection Conexión a la base de datos
 * @return int Número total de categorías
 */
function contarCategorias($conection) {
    try {
        $consulta = $conection->prepare("SELECT COUNT(id_categoria) as total FROM CATEGORIA");
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        
        if ($resultado && isset($resultado['total'])) {
            return (int)$resultado['total'];
        }
        
        // Si no hay categorías en la base de datos, contar las categorías de ejemplo
        $categorias = getAllCategories($conection);
        return count($categorias);
    } catch(PDOException $e) {
        error_log("Error en contarCategorias: " . $e->getMessage());
        return 0;
    }
}

/**
 * Función auxiliar para obtener categorías (para compatibilidad)
 * @return array Arreglo con todas las categorías
 */
function obtenerCategorias() {
    // Categorías de ejemplo
    return [
        [
            'id' => 1,
            'nombre_categoria' => 'Vibradores Mujer',
            'descripcion' => 'Explora nuestra selección de vibradores para mujer.',
            'imagen' => 'img/vibrador-mujer.png',
            'total_productos' => rand(10, 30)
        ],
        [
            'id' => 2,
            'nombre_categoria' => 'Vibradores Hombre',
            'descripcion' => 'Descubre nuestra colección de vibradores para hombre.',
            'imagen' => 'img/vibrador-hombre.png',
            'total_productos' => rand(10, 30)
        ],
        [
            'id' => 3,
            'nombre_categoria' => 'Juguetes para Parejas',
            'descripcion' => 'Encuentra juguetes diseñados para disfrutar en pareja.',
            'imagen' => 'img/jueguete-pareja.png',
            'total_productos' => rand(10, 30)
        ],
        [
            'id' => 4,
            'nombre_categoria' => 'Lubricantes',
            'descripcion' => 'Amplia variedad de lubricantes para mejorar tu experiencia.',
            'imagen' => 'img/lubricantes.png',
            'total_productos' => rand(10, 30)
        ],
        [
            'id' => 6,
            'nombre_categoria' => 'Lencería',
            'descripcion' => 'Lencería sensual para todas las ocasiones.',
            'imagen' => 'img/lenceria.png',
            'total_productos' => rand(10, 30)
        ],
        [
            'id' => 7,
            'nombre_categoria' => 'BDSM',
            'descripcion' => 'Accesorios y juguetes para experiencias BDSM.',
            'imagen' => 'img/bdsm.png',
            'total_productos' => rand(10, 30)
        ]
    ];
}
?>
