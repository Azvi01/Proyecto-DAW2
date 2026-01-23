<?php
    require_once('../app/controllers/SanitizedController.php');
    require_once('../app/models/UserRepository.php');
    
    class LoginController{

        public function auth(){
            if ($_SERVER["REQUEST_METHOD"]=="POST") {
                if (validarEmail($_POST['mail'])) {$email= $_POST['mail'] ;} 
                else {
                    echo('error en el mail');
                }
                if (validarPass($_POST['pass'])) {$pass= $_POST['pass'] ;} 
                else {
                    echo('error en el numero');
                }
                }

                $repo = new UserRepository;

                $userLog = $repo->checkUser($email);
                if ($userLog){
                    echo ($userLog->getMail());
                }else {
                    echo('error usuario no existe');
                }
                
        }

        public function index(){
            View::render('Login');
        }
}
?>
    
