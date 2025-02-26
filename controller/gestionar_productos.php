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

            if (!empty($nombre_producto) && !empty($descripcion) && is_numeric($coste) && $coste > 0 && !empty($id_categoria)) {
                addProducto($conexion, $nombre_producto, $descripcion, $coste, $id_categoria);
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

            if (!empty($id_producto) && !empty($nombre_producto) && !empty($descripcion) && is_numeric($coste) && $coste > 0 && !empty($id_categoria)) {
                editProducto($conexion, $id_producto, $nombre_producto, $descripcion, $coste, $id_categoria);
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
include __DIR__ . '/../views/listado_productos.php';
?>
