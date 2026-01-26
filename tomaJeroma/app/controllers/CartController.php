<?php
require_once('../app/controllers/LoginController.php');
require_once('../app/controllers/ProductsController.php');
require_once('../app/models/ProductsRepository.php');
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

        $contrPro = new ProductsController;
        $contrPro->index();
    }

    public function showCart()
    {
        $repoPro = new ProductsRepository;
        $producto = [];
        $Carrito = Session::get('Carrito');
        foreach ($Carrito as $id) {
            $producto[] = $repoPro->getProduct($id);
        }
        $this->index($producto);
    }

    public function deleteProductToCart() {}

    public function chekLogin()
    {
        if (!Session::get('UserToken')) {
            $loginRepo = new LoginController;
            Session::set("error", "Error, debes iniciar sesión para tener carrito.");
            $loginRepo->index();
            exit;
        } else {
            header('Location: index.php?controller=cart&action=index');
        }
    }

    public function index($data)
    {
        View::render('Cart', ['product' => $data]);
    }
}
