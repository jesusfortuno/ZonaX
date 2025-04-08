<?php
// index.php
session_start();

$action = $_GET['action'] ?? null;

switch ($action) {
    // Resources
    case 'llistar-categories':
        include __DIR__.'/resource_llistar_categories.php';
        break;

    case 'registre':
        include __DIR__.'/resource_registre.php';
        break;

    case 'llistar-productes':
        include __DIR__.'/resource_productos.php';
        break;
    // Añadir en index.php dentro del switch
    case 'producto':
        include __DIR__.'/resource_producto.php';
        break;

    // Añadir en index.php dentro del switch
    case 'carrito':
        include __DIR__.'/views/carrito.php';
        break;
    // New case for category handling
    case 'categoria':
        include __DIR__.'/categoria.php'; // Redirige a la lógica del controlador
        break;
        
    case 'portada':
        include __DIR__.'/resource_portada.php';
        break;

    // Controller
    case 'registre-session':
        include __DIR__.'/controller/almacenar_registro.php';
        break;

    case 'inicio-session':
        include __DIR__.'/controller/llistar_iniciar_sesion.php';
        break;

    case 'verificar-email':
        include __DIR__.'/controller/verificar_email.php';
        break;

    case 'recuperar-password':
        include __DIR__.'/controller/recuperar_password.php';
        break;



    case 'salir':
        session_destroy();
        header('Location: ?action=portada');
        exit();
        break;

    case 'gestionar-productos':
        if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
            header('Location: ?action=portada');
            exit();
        }
        include __DIR__.'/controller/gestionar_productos.php';
        break;

    case 'gestionar-usuarios':
        if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
            header('Location: ?action=portada');
            exit();
        }
        include __DIR__.'/controller/gestionar_usuarios.php';
        break;

    case 'dashboard':
        if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
            error_log("Acceso denegado al dashboard - Usuario: " . ($_SESSION['usuario'] ?? 'no definido') . ", Rol: " . ($_SESSION['rol'] ?? 'no definido'));
            header('Location: ?action=portada');
            exit();
        }
        error_log("Acceso permitido al dashboard - Usuario: " . $_SESSION['usuario']);
        include __DIR__.'/controller/dashboard.php';
        break;

    // Default
    default:
        include __DIR__.'/resource_portada.php';
        break;
}
?>