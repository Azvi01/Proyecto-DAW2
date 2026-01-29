<?php
require_once('../app/controllers/LoginController.php');
require_once('../app/controllers/ProductsController.php');
require_once('../app/models/ProductsRepository.php');
require_once("../app/models/CategoryRepository.php");

class CartController
{

    public function addProductToCart()
    {
        $id = $_POST['idProducto'];
        $cantidad = $_POST['cantidad'];
        $Carrito = Session::get('Carrito') ?? [];

        if (isset($Carrito[$id])) {
            $Carrito[$id]['cantidad'] += $cantidad;
        } else {

            $Carrito[$id] = ['cantidad' => $cantidad];
        }

        Session::set('Carrito', $Carrito);

        header("Location: index.php");
    }

    public function showCart()
    {
        $repoPro = new ProductsRepository;
        $productos = [];
        $Carrito = Session::get('Carrito') ?? [];

        foreach ($Carrito as $idProducto => $info) {
            $producto = $repoPro->getProduct($idProducto);
            $productos[] = $producto;
        }

        $this->index($productos);
    }



    public function chekLogin()
    {
        if (!Session::get('UserToken')) {
            $loginRepo = new LoginController;
            Session::set("error", "Error, debes iniciar sesión para tener carrito.");
            $loginRepo->index();
            exit;
        } else {
            $this->showCart();
        }
    }

    public function addOne() {
        if (!isset($_POST['id'])) return;
        $id = $_POST['id'];
        $carrito = Session::get('Carrito') ?? [];

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
        }

        Session::set('Carrito', $carrito);
        $this->showCart(); 
        exit;
    }

    public function removeOne() {
        if (!isset($_POST['id'])) return;
        $id = $_POST['id'];
        $carrito = Session::get('Carrito') ?? [];

        if (isset($carrito[$id]) && $carrito[$id]['cantidad'] > 1) {
            $carrito[$id]['cantidad']--;
        }

        Session::set('Carrito', $carrito);
        $this->showCart();
        exit;
    }

    public function deleteProductToCart() {
        if (!isset($_POST['id'])) return;
        $id = $_POST['id'];
        $carrito = Session::get('Carrito') ?? [];

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
        }

        Session::set('Carrito', $carrito);
        $this->showCart();;
        exit;
    }

    public function index($data = [])
{
    $repo = new CategoryRepository();
    $categories = $repo->getCategories();
    View::render('Cart', ['product' => $data, 'categories'=>$categories]);
}
}
