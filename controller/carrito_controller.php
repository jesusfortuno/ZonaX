<?php
// controller/carrito_controller.php
require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/productos.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$conection = DB::getInstance();
$error = '';
$mensaje = '';

// Función para obtener el carrito actual desde las cookies
function getCarrito() {
    if (isset($_COOKIE['carrito'])) {
        return json_decode($_COOKIE['carrito'], true);
    }
    return [];
}

// Función para guardar el carrito en las cookies
function guardarCarrito($carrito) {
    setcookie('carrito', json_encode($carrito), time() + (86400 * 30), "/"); // Cookie válida por 30 días
}

// Obtener la operación a realizar
$operacion = $_GET['op'] ?? 'ver';

switch ($operacion) {
    case 'add':
        // Añadir producto al carrito
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_producto = $_POST['id_producto'] ?? '';
            $nombre = $_POST['nombre'] ?? '';
            $precio = $_POST['precio'] ?? 0;
            $cantidad = $_POST['cantidad'] ?? 1;
            $imagen = $_POST['imagen'] ?? '';
            
            if (!empty($id_producto)) {
                $carrito = getCarrito();
                
                // Verificar si el producto ya está en el carrito
                if (isset($carrito[$id_producto])) {
                    // Actualizar cantidad
                    $carrito[$id_producto]['cantidad'] += $cantidad;
                } else {
                    // Añadir nuevo producto
                    $carrito[$id_producto] = [
                        'id' => $id_producto,
                        'nombre' => $nombre,
                        'precio' => $precio,
                        'cantidad' => $cantidad,
                        'imagen' => $imagen
                    ];
                }
                
                guardarCarrito($carrito);
                $mensaje = "Producto añadido al carrito correctamente.";
            }
        }
        break;
        
    case 'remove':
        // Eliminar producto del carrito
        $id_producto = $_GET['id'] ?? '';
        if (!empty($id_producto)) {
            $carrito = getCarrito();
            if (isset($carrito[$id_producto])) {
                unset($carrito[$id_producto]);
                guardarCarrito($carrito);
                $mensaje = "Producto eliminado del carrito.";
            }
        }
        break;
        
    case 'update':
        // Actualizar cantidad de un producto
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_producto = $_POST['id_producto'] ?? '';
            $cantidad = $_POST['cantidad'] ?? 1;
            
            if (!empty($id_producto) && $cantidad > 0) {
                $carrito = getCarrito();
                if (isset($carrito[$id_producto])) {
                    $carrito[$id_producto]['cantidad'] = $cantidad;
                    guardarCarrito($carrito);
                    $mensaje = "Carrito actualizado correctamente.";
                }
            }
        }
        break;
        
    case 'clear':
        // Vaciar el carrito
        setcookie('carrito', '', time() - 3600, "/");
        $mensaje = "Carrito vaciado correctamente.";
        break;
        
    case 'ver':
    default:
        // Ver el carrito (no hace nada especial, solo muestra la vista)
        break;
}

// Obtener el carrito actualizado para la vista
$carrito = getCarrito();

// Calcular el total del carrito
$total = 0;
foreach ($carrito as $item) {
    $total += $item['precio'] * $item['cantidad'];
}

// Incluir la vista
include __DIR__ . '/../views/carrito.php';
?>