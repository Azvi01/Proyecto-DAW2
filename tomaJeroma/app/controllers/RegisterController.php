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
                    Session::set("error", "Error, correo invalido.");
                    header("Location: index.php?controller=Register&action=index");
                exit;
                }

                if (validateNumber($_POST['telfNumber'])) {
                    $telfNumber = $_POST['telfNumber'];
                }else {
                    Session::set("error", "Error, numero de telefono no valido.");
                    header("Location: index.php?controller=Register&action=index");
                    exit;
                }


                if (validarPass($_POST['pass']) && validarPass($_POST['passConf'])) {
                    $pass = $_POST['pass'];
                    $passConf = $_POST['passConf'];
                    if ($pass === $passConf) {
                        $pass = $_POST['pass'];
                    }else {
                    Session::set("error", "Error, las contraseñas no coinciden.");
                    header("Location: index.php?controller=Register&action=index");
                    exit;
                }

                }else {
                    Session::set("error", "Error, contraseña debe tener como minimo 6 digitos.");
                    header("Location: index.php?controller=Register&action=index");
                    exit;
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