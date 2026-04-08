<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtro de Categorías</title>    
</head>
<body>
    <h1>Tienda de Tazas</h1>
    
    <div class="resultado">
        <?php
        // Recibir dato por GET (siempre validar)
        $categoria = $_GET["categoria"] ?? "todas";
        
        echo "Mostrando tazas de: " . htmlspecialchars($categoria);
        ?>
    </div>

    <!-- Filtro con links -->
    <div class="filtro-links">
        <p>Filtrar por categoría:</p>
        <a href="get.php?categoria=todas">Todas</a> | 
        <a href="get.php?categoria=cafe">Café</a> | 
        <a href="get.php?categoria=mate">Mate</a>
    </div>

    <!-- Formulario de filtro -->
    <form method="GET" action="get.php">
        <label for="categoria">Selecciona categoría:</label>
        <select name="categoria" id="categoria">
            <option value="todas">Todas</option>
            <option value="cafe">Café</option>
            <option value="mate">Mate</option>
        </select>
        <button type="submit">Filtrar</button>
    </form>
</body>
</html>