<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Productos</title>
</head>
<body>
    <h1>Registro de Productos</h1>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $nombre = trim($_POST["nombre"] ?? "");
      $precio = floatval($_POST["precio"] ?? 0);

      if (!empty($nombre) && $precio > 0) {
        echo "<p><strong>Producto recibido: $nombre — $$precio MXN</strong></p>";
      } else {
        echo "<p><strong>Error: datos incompletos</strong></p>";
      }
    }
    ?>

    <form method="POST" action="post.php">
      <fieldset>
        <legend>Datos del Producto</legend>
        <div>
          <label for="nombre">Nombre de la taza:</label><br>
          <input type="text" id="nombre" name="nombre" placeholder="Nombre de la taza" required>
        </div>
        <br>
        <div>
          <label for="precio">Precio:</label><br>
          <input type="number" id="precio" name="precio" step="0.01" placeholder="Precio" required>
        </div>
        <br>
        <button type="submit">Guardar</button>
      </fieldset>
    </form>
</body>
</html>