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
    
    // Controller
    case 'registre-session':
        include __DIR__.'/controller/almacenar_registro.php';
        break;

    case 'inicio-session':
        include __DIR__.'/controller/llistar_iniciar_sesion.php';
        break;

    // Default
    default:
        include __DIR__.'/resource_portada.php';
        break;
}

?>