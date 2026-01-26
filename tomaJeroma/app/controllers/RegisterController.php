<?php
    require_once('../app/controllers/SanitizedController.php');
    require_once('../app/controllers/LoginController.php');
    require_once('../app/models/UserRepository.php');
    require_once("../app/models/CategoryRepository.php");


    class RegisterController{

        public function auth(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (validarEmail($_POST['mail'])) {
                    $email = $_POST['mail'];
                }else {
                    echo('error en el mail');
                }

                if (validateNumber($_POST['telfNumber'])) {
                    $telfNumber = $_POST['telfNumber'];
                }else {
                    echo('error en el numero');
                }


                if (validarPass($_POST['pass']) && validarPass($_POST['passConf'])) {
                    $pass = $_POST['pass'];
                    $passConf = $_POST['passConf'];
                    if ($pass === $passConf) {
                        $pass = $_POST['pass'];
                    }else {
                    echo('error en el pass (No son iguales)');
                }

                }else {
                    echo('error en la pass');
                }


                $this->createUser($email, $telfNumber, $pass);
                $login = new LoginController;
                $login->index();
            }
        }
            public function createUser(string  $email, int $telfNumber, string $pass)
            {
                $u = new User;
                $u->mail = $email;
                $u->telf = $telfNumber;
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                $u->hashed_pass = $hash;

                $repo = new UserRepository;
                $repo->RegisterUser($u);
            }

            public function index()
            {
                $repo = new CategoryRepository();
                $categories = $repo->getCategories();
                View::render('Register', ['categories'=>$categories]);
            }
            
            
                
}
?>