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

<form method="POST" action="guardar_producto.php" enctype="multipart/form-data" class="form-producto">
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
  <div class="campo">
    <label>Imagen del producto</label>
    <input type="file" name="imagen" id="inputImagen" accept="image/*" onchange="previsualizarImagen(this)">
    <div id="contenedor-preview" style="display:none; margin-top:10px;">
      <img id="preview-imagen" style="max-width:200px; border-radius:8px;">
    </div>
  </div>
  <button type="submit" class="btn-primario">💾 Guardar producto</button>
  <a href="index.php" class="btn-secundario">Cancelar</a>
</form>

<script>
function previsualizarImagen(input) {
  const contenedor = document.getElementById("contenedor-preview");
  const preview    = document.getElementById("preview-imagen");

  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = (e) => {
      preview.src = e.target.result;
      contenedor.style.display = "block";
    };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>

<?php require_once "includes/footer.php"; ?>
