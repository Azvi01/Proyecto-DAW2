<?php
    require_once('../app/controllers/SanitizedController.php');
    class LoginController{

        public function auth(){
            if ($_SERVER["REQUEST_METHOD"]=="POST") {
                if (validarEmail($_POST['mail'])) {$email= $_POST['mail'] ;} 
                
                if (validarPass($_POST['pass'])) {$pass= $_POST['pass'] ;} 
                }
        }

        public function index(){
            View::render('Login');
        }
}
?>
    
