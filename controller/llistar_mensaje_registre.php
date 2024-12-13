<?php

require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/mensajes.php';

$conection = DB::getInstance();
$mensaje = getMensaje($conection, 2);

include __DIR__ . '/../views/llistar_mensaje_registre.php';

?>