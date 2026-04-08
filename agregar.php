<?php
session_start();
$page_title = "Agregar Taza";
require_once "includes/header.php";

$mensaje_error = $_SESSION["error"] ?? "";
unset($_SESSION["error"]);
?>

<h2>Agregar nueva taza</h2>

<?php if ($mensaje_error): ?>
  <p class="mensaje-error"><?php echo htmlspecialchars($mensaje_error); ?></p>
<?php endif; ?>

<form method="POST" action="guardar_producto.php" class="form-producto">
  <div class="campo">
    <label>Nombre *</label>
    <input type="text" name="nombre" required>
  </div>
  <div class="campo">
    <label>Descripción</label>
    <textarea name="descripcion" rows="4"></textarea>
  </div>
  <div class="campo">
    <label>Precio *</label>
    <input type="number" name="precio" step="0.01" required>
  </div>
  <div class="campo">
    <label>Categoría *</label>
    <input type="text" name="categoria" required>
  </div>
  <div class="campo">
    <label>Stock</label>
    <input type="number" name="stock" value="0" min="0">
  </div>
  <button type="submit" class="btn-primario">Guardar producto</button>
  <a href="index.php" class="btn-secundario">Cancelar</a>
</form>

<?php require_once "includes/footer.php"; ?>
