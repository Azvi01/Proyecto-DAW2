<?php 
    class View{

        public static function render($nombre, $datos=[]) : void {
            extract($datos);
            
            ob_start();
            $rutaVista = "../app/views/$nombre.php";

            if (file_exists($rutaVista)) {
                require $rutaVista;
            }else{
                die("Error: La vista $nombre no existe.");
            }

            $content = ob_get_clean();
            require "../app/views/layout/main.php";
        }
    }
?>