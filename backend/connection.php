<?php
require_once "./config.php";

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

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
