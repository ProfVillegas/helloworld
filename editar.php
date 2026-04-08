<?php
session_start();
require_once "includes/conexion.php";

$id = intval($_GET["id"] ?? 0);
if ($id <= 0) {
  header("Location: index.php");
  exit;
}

$stmt = $conn->prepare("SELECT * FROM productos WHERE id=? AND activo=1");
$stmt->bind_param("i", $id);
$stmt->execute();
$producto = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$producto) {
  header("Location: index.php");
  exit;
}

$page_title = "Editar Taza";
require_once "includes/header.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nombre      = trim($_POST["nombre"] ?? "");
  $descripcion = trim($_POST["descripcion"] ?? "");
  $precio      = floatval($_POST["precio"] ?? 0);
  $categoria   = trim($_POST["categoria"] ?? "");
  $stock       = intval($_POST["stock"] ?? 0);

  if (empty($nombre) || $precio <= 0 || empty($categoria)) {
    $mensaje_error = "Todos los campos obligatorios deben completarse.";
  } else {
    $sql = "UPDATE productos SET nombre=?, descripcion=?, precio=?, categoria=?, stock=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdsii", $nombre, $descripcion, $precio, $categoria, $stock, $id);

    if ($stmt->execute()) {
      $_SESSION["exito"] = "Taza actualizada correctamente.";
      $stmt->close();
      $conn->close();
      header("Location: index.php");
      exit;
    }

    $mensaje_error = "Error al actualizar: " . $stmt->error;
    $stmt->close();
  }
}
?>

<h2>Editar taza</h2>

<?php if (!empty($mensaje_error)): ?>
  <p class="mensaje-error"><?php echo htmlspecialchars($mensaje_error); ?></p>
<?php endif; ?>

<form method="POST" class="form-producto">
  <div class="campo">
    <label>Nombre *</label>
    <input type="text" name="nombre" required value="<?= htmlspecialchars($producto["nombre"]); ?>">
  </div>
  <div class="campo">
    <label>Descripción</label>
    <textarea name="descripcion" rows="4"><?= htmlspecialchars($producto["descripcion"]); ?></textarea>
  </div>
  <div class="campo">
    <label>Precio *</label>
    <input type="number" name="precio" step="0.01" required value="<?= htmlspecialchars($producto["precio"]); ?>">
  </div>
  <div class="campo">
    <label>Categoría *</label>
    <input type="text" name="categoria" required value="<?= htmlspecialchars($producto["categoria"]); ?>">
  </div>
  <div class="campo">
    <label>Stock</label>
    <input type="number" name="stock" min="0" value="<?= htmlspecialchars($producto["stock"]); ?>">
  </div>
  <button type="submit" class="btn-primario">💾 Guardar Cambios</button>
  <a href="index.php" class="btn-secundario">Cancelar</a>
</form>

<?php require_once "includes/footer.php"; ?>
