<?php require_once "../includes/conexion.php"; ?>

<!-- ── CREATE ── -->
<?php
$stmt = $conn->prepare("INSERT INTO productos (nombre, precio, categoria) VALUES (?,?,?)");
$stmt->bind_param("sds", $nombre, $precio, $categoria);
$nombre = "Taza Nueva"; $precio = 99.99; $categoria = "Café";
$stmt->execute();
echo "Creado con ID: " . $conn->insert_id;
$stmt->close();
?>

<!-- ── READ ── -->
<?php
$result = $conn->query("SELECT * FROM productos WHERE activo=1 ORDER BY fecha_alta DESC");
while ($fila = $result->fetch_assoc()) {
  echo $fila["nombre"] . " — $" . $fila["precio"] . "<br>";
}
?>

<!-- ── UPDATE ── -->
<?php
$stmt = $conn->prepare("UPDATE productos SET precio=? WHERE id=?");
$stmt->bind_param("di", $nuevo_precio, $id);
$nuevo_precio = 129.99; 
$id = 1;
$stmt->execute();
echo "Filas actualizadas: " . $stmt->affected_rows;
$stmt->close();
?>

<!--Active / Desactive -->
<?php
 $stmt= $conn->prepare("Update productos SET activo=0 where id=?");
 $stmt->bind_param("i",$id);
 $id=2;
 $stmt->execute();
 $stmt->close();
?>
