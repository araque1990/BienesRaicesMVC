<?php
namespace App\Config;
use mysqli;
use mysqli_sql_exception;

class Database {
    public static function conectarDB(): mysqli
{
    // Buscamos las variables en $_SERVER (donde Docker las pone por defecto)
    $host = $_SERVER['DB_HOST'] ?? getenv('DB_HOST');
    $user = $_SERVER['DB_USER'] ?? getenv('DB_USER');
    $pass = $_SERVER['DB_ROOT_PASSWORD'] ?? getenv('DB_ROOT_PASSWORD');
    $bd = $_SERVER['DB_NAME'] ?? getenv('DB_NAME');

    if (!$host || !$user || !$bd) {
        echo "Error Crítico: Faltan variables de entorno para la conexión.";
        exit;
    }

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try {
        $db = new mysqli($host, $user, $pass, $bd);
        return $db;
    } catch (mysqli_sql_exception $e) {
        echo "Error de conexión: " . $e->getMessage();
        exit;
    }
}
}
