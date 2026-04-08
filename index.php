<?php
session_start();
$page_title = "Catálogo de Tazas";
require_once "includes/conexion.php";
require_once "includes/header.php";

$mensaje_exito = $_SESSION["exito"] ?? "";
$mensaje_error = $_SESSION["error"] ?? "";
unset($_SESSION["exito"], $_SESSION["error"]);

$sql = "SELECT * FROM productos WHERE activo=1 ORDER BY fecha_alta DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$productos = $stmt->get_result();
?>

<h2>Catálogo</h2>

<?php if ($mensaje_exito): ?>
  <p class="mensaje-exito"><?php echo htmlspecialchars($mensaje_exito); ?></p>
<?php endif; ?>

<?php if ($mensaje_error): ?>
  <p class="mensaje-error"><?php echo htmlspecialchars($mensaje_error); ?></p>
<?php endif; ?>

<?php if ($productos->num_rows === 0): ?>
  <p>No se encontraron tazas activas.</p>
<?php else: ?>
  <div class="grid-productos">
    <?php while ($producto = $productos->fetch_assoc()): ?>
      <article class="tarjeta-producto">
        <h3><?= htmlspecialchars($producto["nombre"]); ?></h3>
        <p class="categoria"><?= htmlspecialchars($producto["categoria"]); ?></p>
        <p class="descripcion"><?= nl2br(htmlspecialchars($producto["descripcion"])); ?></p>
        <p class="precio">$<?= number_format($producto["precio"], 2); ?> MXN</p>
        <p class="stock">Stock: <?= htmlspecialchars($producto["stock"]); ?></p>
        <div class="acciones">
          <a href="editar.php?id=<?= $producto["id"];?>" class="btn-editar">✏️ Editar</a>
          <a href="eliminar.php?id=<?= $producto["id"];?>" class="btn-eliminar" onclick="return confirm('¿Eliminar esta taza?');">🗑️ Eliminar</a>
        </div>
      </article>
    <?php endwhile; ?>
  </div>
<?php endif; ?>

<?php
$stmt->close();
$conn->close();
require_once "includes/footer.php";
