<?php
    require_once("../app/libs/View.php");
    require_once("../app/libs/Session.php");
    require_once("../app/libs/JWTToken.php");

    Session::init();
    
    $nombre_controlador = $_GET['controller'] ?? 'Products';
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