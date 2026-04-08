<?php

require_once("../includes/conexion.php");

if($_SERVER["REQUEST_METHOD"] !== "POST"){
    header("location: nuevo.php");
    exit;
}

//Recopila los datos del formulario
$nombre = trim($_POST["nombre"]);
$descripcion =trim($_POST["descripcion"]);
$precio = floatval($_POST["precio"]);
$categoria =trim($_POST["categoria"]);
$stock =intval($_POST["stock"]);
$image ="default.jpg";

//Validar
if(empty($nombre) || $precio<=0 || empty($categoria)){
    $_SESSION["error"]="<b>Todos los campos son obligatorios</b>";
    header("location: nuevo.php");
    exit;
}
?>