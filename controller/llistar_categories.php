<?php

require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/categories.php';

$conection = DB::getInstance();
$categories = getCategories($conection);

include __DIR__ . '/../views/llistar_categories.php';

?>