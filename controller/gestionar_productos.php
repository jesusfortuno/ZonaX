<?php
require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/productos.php';

$conexion = DB::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';

    switch ($accion) {
        case 'add':
            $nombre_producto = trim($_POST['nombre_producto'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');
            $coste = $_POST['coste'] ?? '';
            $id_categoria = $_POST['id_categoria'] ?? '';
            $imagen = $_FILES['imagen'] ?? null;

            if ($imagen && $imagen['error'] === UPLOAD_ERR_OK) {
                $ruta_imagen = 'img/' . basename($imagen['name']);
                move_uploaded_file($imagen['tmp_name'], $ruta_imagen);
            } else {
                $ruta_imagen = null;
            }

            if (!empty($nombre_producto) && !empty($descripcion) && is_numeric($coste) && $coste > 0 && !empty($id_categoria)) {
                addProducto($conexion, $nombre_producto, $descripcion, $coste, $id_categoria, $ruta_imagen);
                header('Location: ?action=listar_productos');
                exit();
            } else {
                $error = "Datos inválidos para añadir el producto.";
            }
            break;

        case 'edit':
            $id_producto = $_POST['id_producto'] ?? '';
            $nombre_producto = trim($_POST['nombre_producto'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');
            $coste = $_POST['coste'] ?? '';
            $id_categoria = $_POST['id_categoria'] ?? '';
            $imagen = $_FILES['imagen'] ?? null;

            // Obtener la imagen existente de la base de datos
            $producto_existente = getProductoById($conexion, $id_producto); // Asegúrate de tener esta función
            $ruta_imagen = $producto_existente['imagen']; // Mantener la imagen existente por defecto

            if ($imagen && $imagen['error'] === UPLOAD_ERR_OK) {
                $ruta_imagen = 'img/' . basename($imagen['name']);
                move_uploaded_file($imagen['tmp_name'], $ruta_imagen);
            }

            if (!empty($id_producto) && !empty($nombre_producto) && !empty($descripcion) && is_numeric($coste) && $coste > 0 && !empty($id_categoria)) {
                editProducto($conexion, $id_producto, $nombre_producto, $descripcion, $coste, $id_categoria, $ruta_imagen);
                header('Location: ?action=listar_productos');
                exit();
            } else {
                $error = "Datos inválidos para editar el producto.";
            }
            break;

        case 'delete':
            $id_producto = $_POST['id_producto'] ?? '';
            if (!empty($id_producto)) {
                deleteProducto($conexion, $id_producto);
                header('Location: ?action=listar_productos');
                exit();
            } else {
                $error = "ID de producto inválido para eliminar.";
            }
            break;

        default:
            $error = "Acción no válida.";
            break;
    }
}

// Obtener la lista de productos para mostrar
$productos = getProductos($conexion);

// Asegurarse de que cada producto tenga un campo 'id' para compatibilidad
foreach ($productos as &$producto) {
    if (!isset($producto['id']) && isset($producto['id_producto'])) {
        $producto['id'] = $producto['id_producto'];
    }
}

include __DIR__ . '/../views/listado_productos.php';
?>
