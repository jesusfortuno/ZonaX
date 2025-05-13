<?php
// controller/carrito_controller.php
require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/productos.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Configuración de errores
error_reporting(E_ALL);
ini_set('display_errors', 0); // No mostrar errores en pantalla
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../error.log');

$conection = DB::getInstance();
$error = '';
$mensaje = '';

// Función para obtener el carrito actual desde la sesión
function getCarrito() {
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }
    return $_SESSION['carrito'];
}

// Función para guardar el carrito en la sesión
function guardarCarrito($carrito) {
    $_SESSION['carrito'] = $carrito;
}

// Obtener la operación a realizar
$operacion = $_GET['op'] ?? 'ver';

switch ($operacion) {
    case 'add':
        // Añadir producto al carrito
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_producto = isset($_POST['id_producto']) ? $_POST['id_producto'] : '';
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
            $precio = isset($_POST['precio']) ? (float)$_POST['precio'] : 0;
            $cantidad = isset($_POST['cantidad']) ? (int)$_POST['cantidad'] : 1;
            $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : '';
            
            error_log("Añadiendo producto al carrito: ID=$id_producto, Nombre=$nombre, Precio=$precio, Cantidad=$cantidad");
            
            if (!empty($id_producto)) {
                // Asegurarse de que el carrito existe en la sesión
                if (!isset($_SESSION['carrito'])) {
                    $_SESSION['carrito'] = [];
                }
                
                // Verificar si el producto ya está en el carrito
                if (isset($_SESSION['carrito'][$id_producto])) {
                    // Actualizar cantidad
                    $_SESSION['carrito'][$id_producto]['cantidad'] += $cantidad;
                    error_log("Producto ya en carrito, actualizando cantidad a: " . $_SESSION['carrito'][$id_producto]['cantidad']);
                } else {
                    // Añadir nuevo producto
                    $_SESSION['carrito'][$id_producto] = [
                        'id' => $id_producto,
                        'nombre' => $nombre,
                        'precio' => $precio,
                        'cantidad' => $cantidad,
                        'imagen' => $imagen
                    ];
                    error_log("Nuevo producto añadido al carrito");
                }
                
                $mensaje = "Producto añadido al carrito correctamente.";
                
                // Redireccionar a la página del carrito
                header("Location: index.php?action=carrito&op=ver");
                exit;
            } else {
                $error = "Error: No se pudo añadir el producto al carrito.";
                error_log("Error: ID de producto vacío");
            }
        } elseif (isset($_GET['id'])) {
            // Añadir producto desde un enlace (GET)
            $id_producto = $_GET['id'];
            
            // Obtener información del producto desde la base de datos
            $producto = getProductoById($conection, $id_producto);
            
            if ($producto) {
                $carrito = getCarrito();
                
                // Verificar si el producto ya está en el carrito
                if (isset($carrito[$id_producto])) {
                    // Actualizar cantidad
                    $carrito[$id_producto]['cantidad'] += 1;
                } else {
                    // Añadir nuevo producto
                    $carrito[$id_producto] = [
                        'id' => $id_producto,
                        'nombre' => $producto['nombre_producto'],
                        'precio' => $producto['coste'],
                        'cantidad' => 1,
                        'imagen' => $producto['imagen']
                    ];
                }
                
                guardarCarrito($carrito);
                $mensaje = "Producto añadido al carrito correctamente.";
            } else {
                $error = "Error: No se encontró el producto.";
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
            $cantidad = (int)($_POST['cantidad'] ?? 1);
            
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
        $_SESSION['carrito'] = [];
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
