<?php
session_start();
require_once "includes/conexion.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header("Location: agregar.php");
  exit;
}

$nombre      = trim($_POST["nombre"] ?? "");
$descripcion = trim($_POST["descripcion"] ?? "");
$precio      = floatval($_POST["precio"] ?? 0);
$categoria   = trim($_POST["categoria"] ?? "");
$stock       = intval($_POST["stock"] ?? 0);
$imagen      = "default.jpg";

if (empty($nombre) || $precio <= 0 || empty($categoria)) {
  $_SESSION["error"] = "Todos los campos obligatorios deben completarse.";
  header("Location: agregar.php");
  exit;
}

$sql = "INSERT INTO productos (nombre, descripcion, precio, categoria, stock, imagen) VALUES (?,?,?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdsis", $nombre, $descripcion, $precio, $categoria, $stock, $imagen);

if ($stmt->execute()) {
  $id_nuevo = $conn->insert_id;
  $_SESSION["exito"] = "Taza '$nombre' guardada correctamente (ID: $id_nuevo)";
  header("Location: index.php");
} else {
  $_SESSION["error"] = "Error al guardar: " . $stmt->error;
  header("Location: agregar.php");
}

$stmt->close();
$conn->close();
exit;
