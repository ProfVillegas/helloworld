<?php
define('DB_HOST', 'localhost');
define('DB_USUARIO','root');
define('DB_PASSWORD','');
define('DB_NOMBRE','helloworld');

$conn = new mysqli(
DB_HOST, DB_USUARIO,
DB_PASSWORD,DB_NOMBRE
);

if($conn->connect_error){
    die('Error: '.$conn->connect_error);
}

$conn->set_charset('utf8mb4');
?>