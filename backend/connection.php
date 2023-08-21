<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
header('Access-Control-Allow-Headers: token, Content-Type');
header('Access-Control-Max-Age: 1728000');
header('Content-Type: application/json');

$IP = 'localhost';
$USER = 'root';
$PASSWORD = '';
$DATABASE = 'crud_angular_php';

define('IP', $IP);
define('USER', $USER);
define('PASSWORD', $PASSWORD);
define('DATABASE', $DATABASE);

try {
    $connection = mysqli_connect(IP, USER, PASSWORD, DATABASE) or die('Não foi possível conectar ao Banco de dados!');
    mysqli_set_charset($connection, "utf8");
} catch (\Throwable $th) {
    //throw $th;
}
