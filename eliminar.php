<?php
session_start();
require_once "includes/conexion.php";

$id = intval($_GET["id"] ?? 0);

if ($id > 0) {
  $stmt = $conn->prepare("UPDATE productos SET activo=0 WHERE id=?");
  $stmt->bind_param("i", $id);

  if ($stmt->execute() && $stmt->affected_rows > 0) {
    $_SESSION["exito"] = "Producto eliminado correctamente.";
  } else {
    $_SESSION["error"] = "No se pudo eliminar el producto.";
  }

  $stmt->close();
}

$conn->close();
header("Location: index.php");
exit;
