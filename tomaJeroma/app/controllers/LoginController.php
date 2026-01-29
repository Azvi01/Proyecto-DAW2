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
                Session::set("error", "Error, el usuario no existe.");
                header("Location: index.php?controller=Login&action=index");
                exit;
            }
            if (validarPass($_POST['pass'])) {
                $pass = $_POST['pass'];
            } else {
                Session::set("error", "Error, contraseña incorrrecta.");
                header("Location: index.php?controller=Login&action=index");
                exit;
            }
        }

        $repo = new UserRepository;

        $userLog = $repo->checkUser($email);
        if ($userLog) {
            $userMail = $userLog->getMail();
            $userPass = $userLog->getHashed_pass();
            $userRole = $userLog->getRole();
            $userId = $userLog->getId();
            if (!password_verify($pass, $userPass)) {
                Session::set("error", "Error, contraseña incorrrecta.");
                header("Location: index.php?controller=Login&action=index");
                exit;
            }


            $Token = JWTToken::generarToken($userMail, $userRole, $userId);

            Session::set('UserToken', $Token);
        } else {

            Session::set("error", "Error, el usuario no existe.");
            header("Location: index.php?controller=Login&action=index");
            exit;
        }



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

    public function logout()
    {
        Session::delete('UserToken');
        Session::destroy();
        $this->index();
    }
}
