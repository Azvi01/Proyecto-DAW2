    <?php
    function auth(){
        require_once('../app/controllers/SanitizedController.php');
        if ($_SERVER["REQUEST_METHOD"]=="POST") {
            if (validarEmail($_POST['mail'])) {$email= $_POST['mail'] ?? '';} 
            
            if (validarPass($_POST['pass'])) {$pass= $_POST['pass'] ?? '';} 
        }
    }
    ?>
    
