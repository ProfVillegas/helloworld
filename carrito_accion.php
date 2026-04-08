<?php
session_start();
require_once "includes/conexion.php";

// Acción solicitada: agregar/quitar/eliminar/vaciar
$accion = $_GET["accion"] ?? "";
$id     = intval($_GET["id"] ?? 0);

// Inicializar carrito si no existe
if (!isset($_SESSION["carrito"])) {
  $_SESSION["carrito"] = [];
}

switch ($accion) {
  case "agregar":
    // Verificar que el producto existe, está activo y hay stock disponible
    $stmt = $conn->prepare("SELECT * FROM productos WHERE id=? AND activo=1 AND stock>0");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $prod = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if ($prod) {
      if (isset($_SESSION["carrito"][ $id ])) {
        // Incrementar cantidad sin sobrepasar el stock
        if ($_SESSION["carrito"][ $id ]["cantidad"] < $prod["stock"]) {
          $_SESSION["carrito"][ $id ]["cantidad"]++;
        }
      } else {
        // Agregar producto nuevo al carrito
        $_SESSION["carrito"][ $id ] = [
          "id"       => $prod["id"],
          "nombre"   => $prod["nombre"],
          "precio"   => $prod["precio"],
          "imagen"   => $prod["imagen"],
          "cantidad" => 1,
        ];
      }

      $_SESSION["exito"] = "✅ '" . $prod["nombre"] . "' agregado al carrito.";
    }
    break;

  case "quitar":
    // Reducir la cantidad o eliminar si queda 0
    if (isset($_SESSION["carrito"][ $id ])) {
      if ($_SESSION["carrito"][ $id ]["cantidad"] > 1) {
        $_SESSION["carrito"][ $id ]["cantidad"]--;
      } else {
        unset($_SESSION["carrito"][ $id ]);
      }
    }
    break;

  case "eliminar":
    // Eliminar completamente el producto del carrito
    unset($_SESSION["carrito"][ $id ]);
    break;

  case "vaciar":
    // Vaciar todo el carrito
    $_SESSION["carrito"] = [];
    $_SESSION["exito"] = "Carrito vaciado.";
    break;
}

$conn->close();

// Volver a la página anterior para mantener el flujo del usuario
header("Location: " . ($_SERVER["HTTP_REFERER"] ?? "carrito.php"));
exit;
