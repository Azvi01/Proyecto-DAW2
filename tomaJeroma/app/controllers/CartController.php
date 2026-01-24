<?php
require_once('../app/controllers/LoginController.php');
require_once('../app/models/ProductsRepository.php');
class CartController {

public function addProductToCart(int $id)  {
    $Carrito =Session::get('Carrito') ?? [];
    $repoPro = new ProductsRepository;
    $producto = $repoPro->getProduct($id);
    array_push($Carrito, $producto);
    Session::set('Carrito',$Carrito);
}

public function deleteProductToCart()  {
    
}

public function chekLogin()  {
    if(!Session::get('UserToken')){
        $loginRepo = new LoginController;
        Session::set("error", "Error, debes iniciar sesión para tener carrito.");
        $loginRepo->index();
        exit;
    }else {
        header('Location: index.php?controller=cart&action=index');
    }
}

public function index() {
    View::render('Cart');
}
    
    }
?>