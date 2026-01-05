<?php
    require_once('../app/controllers/LoginController.php');

    function sanitizarTexto(string $texto){
        return htmlspecialchars($texto, ENT_QUOTES, "UTF-8");
    }

    function sanitizarEmail(string $email) {
        return filter_var($email, FILTER_SANITIZE_EMAIL);
    }

    function validarEmail($email){
        if(sanitizarEmail($email)){
            return filter_var($email, FILTER_VALIDATE_EMAIL);   
        } else {
            return false;
        }
    }

    function validarPass($pass){
        if (sanitizarTexto($pass) && strlen(sanitizarTexto($pass))>6) {
            return true;
        } else {
            return false;
        }
    }
?>