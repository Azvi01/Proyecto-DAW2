<?php
require_once('../app/controllers/SanitizedController.php');
require_once('../app/models/UserRepository.php');
require_once('../app/controllers/ProductsController.php');
require_once '../app/libs/JWTToken.php';
require_once '../app/libs/Session.php';
class LoginController
{

    public function auth()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (validarEmail($_POST['mail'])) {
                $email = $_POST['mail'];
            } else {
                echo ('error en el mail');
            }
            if (validarPass($_POST['pass'])) {
                $pass = $_POST['pass'];
            } else {
                echo ('error en el numero');
            }
        }

        $repo = new UserRepository;

        $userLog = $repo->checkUser($email);
        if ($userLog) {
            $userMail = $userLog->getMail();
            $userPass = $userLog->getHashed_pass();
            $userRole = $userLog->getRole();
            if (!password_verify($pass, $userPass)) {
                Session::set("error", "Error, contraseña incorrrecta.");
                header("Location: index.php");
                exit;
            }


            $Token = JWTToken::generarToken($userMail, $userRole);

            Session::set('UserToken', $Token);
            echo JWTToken::rescueMail($Token);
        } else {

            Session::set("error", "Error, el usuario no existe.");
            header("Location: index.php");
            exit;
        }



        $this->index();
    }

    public function index()
    {
        View::render('Login');
    }

    public function deleteUser()
    {
        $repo = new UserRepository;
        $repo->deleteUserById($_POST['id']);
        $this->index();
    }

    public function logout()
    {
        Session::delete('UserToken');
        Session::destroy();
        $this->index();
    }
}
