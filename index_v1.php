<?php
  // Variables simples
  $tienda = "Tazas del Mundo";
  $anio   = 2025;
  $precio = 149.99;

  // Array de productos
  $tipos = ["Café", "Rústica", "Metálica", "Para Mate"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title><?php echo $tienda; ?></title>
</head>
<body>
  <h1><?php echo $tienda; ?></h1>
  <p>Año: <?php echo $anio; ?></p>
  <p>Precio desde: $<?php echo $precio; ?> MXN</p>

  <h2>Tipos de tazas:</h2>
  <ul>
    <?php foreach($tipos as $tipo): ?>
      <li><?php echo $tipo; ?></li>
    <?php endforeach; ?>
  </ul>
</body>
</html>
