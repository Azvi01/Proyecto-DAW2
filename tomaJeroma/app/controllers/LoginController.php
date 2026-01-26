<?php
require_once('../app/controllers/SanitizedController.php');
require_once('../app/models/UserRepository.php');
require_once('../app/controllers/ProductsController.php');
require_once '../app/libs/JWTToken.php';
require_once '../app/libs/Session.php';
require_once("../app/models/CategoryRepository.php");

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
        } else {
            echo ('error usuario no existe');
        }

        if (password_verify($pass, $userPass)) {
            echo ('todo piola');
        } else {

            echo ('La contraseña no coincide');
        }

        $Token = JWTToken::generarToken($userMail,$userRole);

        Session::set('UserToken', $Token);
        echo JWTToken::rescueMail($Token);
        
        $this->index();
    }

    public function index()
    {
        $repo = new CategoryRepository();
        $categories = $repo->getCategories();
        View::render('Login', ['categories'=>$categories]);
    }

    public function deleteUser()
    {
        $repo = new UserRepository;
        $repo->deleteUserById($_POST['id']);
        $this->index();
    }
        
    public function logout()  {
            Session::delete('UserToken');
            Session::destroy();
            $this->index();
    }
}
