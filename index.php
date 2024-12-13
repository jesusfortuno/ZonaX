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

    case 'inicio-sesion':
        include __DIR__.'/resource_iniciar.php';
        break;

    case 'registre-session':
        include __DIR__.'/controller/almacenar_registro.php';
        break;

    case 'inicio-session':
        include __DIR__.'/controller/iniciar_sesion.php';
        break;

    case 'ejemplo':
        include __DIR__.'/resource_ejemplo.php';
        break;

    case 'boton':
        include __DIR__.'/resource_ajax.php';
        break;

    // Default
    default:
        include __DIR__.'/resource_portada.php';
        break;
}

?>