<?php
define('SERVER', 'localhost');
define('USER', 'root');
define('PASSWORD', 'Casa2468$');
define('BD', 'system_uptb');

define('APP_NAME', 'SISTEMA DE GESTIÓN UPTB');
define('APP_URL', 'http://localhost/system_uptb/');
define('KEY_API_MAPS', '');

$server = "mysql:dbname=".BD.";host=".SERVER;

try {
    $pdo = new PDO($server, USER, PASSWORD, [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    //echo "Successful connection to the database";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

date_default_timezone_set("America/Caracas");
$dateTime = date(format: 'Y-m-d H:i:s ');

$currentDate = date(format: 'Y-m-d');
$currentDay = date(format: 'd');
$currentMonth = date(format: 'm');
$currentYear = date(format: 'Y');

//Estado de Registro
$registration_status = '1';

?>
