<?php

use App\Models\ActiveRecord;
use App\Config\Database;
require __DIR__ . '/../vendor/autoload.php';

// Cargar variables de entorno (.env)
$path = dirname(__DIR__);

$dotenv = Dotenv\Dotenv::createImmutable($path);
$dotenv->safeLoad();

// Conectarnos a la BD
$db = Database::conectarDB();

ActiveRecord::setDB($db);

