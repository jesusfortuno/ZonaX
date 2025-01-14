<?php
require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/usuarios.php';

header('Content-Type: application/json');

$email = $_POST['email'] ?? '';
$response = ['exists' => false];

if ($email) {
    $connection = DB::getInstance();
    $response['exists'] = emailExiste($connection, $email);
}

echo json_encode($response);
?>