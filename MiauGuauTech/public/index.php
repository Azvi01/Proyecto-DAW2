<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiauGuauTech</title>
</head>
<body>

<h1>
  MiauGuauTech 🐱🐶
</h1>

        <?php
    $conexion = new mysqli("db", "prueba", "root", "eCommerce");
    $conexion->set_charset("utf8");

    $resultado = $conexion->query("SELECT * FROM products");
    
    if ($resultado && $resultado->num_rows > 0) :
        while ($fila = $resultado->fetch_assoc()) :
?>

<img src="<?= $fila['img'] ?>?>"  class="">
<?php
    endwhile;
    endif;
?>
</body>
</html>