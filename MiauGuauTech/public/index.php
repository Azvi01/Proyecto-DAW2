<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiauGuauTech</title>
</head>

<body>
    <?php

    $nombre_controlador = $_GET['controller'] ?? 'Home';
    $accion = $_GET['action'] ?? 'index';

    $nombre_clase = ucfirst($nombre_controlador) . 'Controller';

    $ruta_archivo = "../app/controllers/" . $nombre_clase . ".php";
    if (file_exists($ruta_archivo)) {
        require_once $ruta_archivo;


        $controlador = new $nombre_clase();

        if (method_exists($controlador, $accion)) {
            $controlador->$accion();
        } else {
            echo "Error: La acción no existe.";
        }
    } else {
        echo "Error: El controlador no existe.";
    }
    ?>
</body>

</html>