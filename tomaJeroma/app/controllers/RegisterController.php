    <?php
    function auth(){
        require_once('../app/controllers/SanitizedController.php');
        if ($_SERVER["REQUEST_METHOD"]=="POST") {
            if (validarEmail($_POST['mail'])) {$email= $_POST['mail'] ?? '';} 
            
            if (validateNumber($_POST['telfNumber'])) {$telfNumber= $_POST['telfNumber'] ?? '';}

            if (validarPass($_POST['pass']) && validarPass($_POST['passConf'])) {
                if($pass === $passConf){ 
                    $pass= $_POST['pass'] ?? '';
                    }
                } 

        }
    }
    ?>