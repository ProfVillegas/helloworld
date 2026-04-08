<?php 

// Configuración global de la tienda 

$tienda_nombre = "Tazas del Mundo"; 

$tienda_version = "1.0"; 

?> 

<!DOCTYPE html> 

<html lang="es"> 

<head> 

  <meta charset="UTF-8"> 

  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

  <title><?= $tienda_nombre; ?> - <?= $page_title ?? "Inicio"; ?></title> 

  <link rel="stylesheet" href="css/style.css"> 

</head> 

<body> 

<header class="site-header"> 

  <div class="header-inner"> 

    <h1 class="logo"><?= $tienda_nombre; ?></h1> 

    <nav> 

      <a href="index.php">Inicio</a> 

      <a href="agregar.php">Agregar Taza</a> 

      <a href="carrito.php">Carrito 

        <?php if(!empty($_SESSION["carrito"])): ?> 

          <span class="badge"><?= count($_SESSION["carrito"]); ?></span> 

        <?php endif; ?> 

      </a> 

    </nav> 

  </div> 

</header> 

<main class="container"> 
