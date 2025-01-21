<?php

class DB {
    protected static $instance;

    protected function __construct() {}

    public static function getInstance() {
        if(empty(self::$instance)) {
            try {
                // Configuración de la base de datos
                $db_info = array(
                    "db_host" => "localhost",
                    "db_port" => "3306",
                    "db_user" => "root",
                    "db_pass" => "",
                    "db_name" => "zonax"  // Asegúrate de que este es el nombre correcto de tu base de datos
                );

                // Crear la conexión PDO
                self::$instance = new PDO(
                    "mysql:host=" . $db_info['db_host'] . 
                    ";port=" . $db_info['db_port'] . 
                    ";dbname=" . $db_info['db_name'] . 
                    ";charset=utf8mb4",
                    $db_info['db_user'],
                    $db_info['db_pass'],
                    array(
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
                    )
                );

            } catch(PDOException $error) {
                error_log("Error de conexión: " . $error->getMessage());
                die("Error de conexión a la base de datos");
            }
        }

        return self::$instance;
    }
}

?>