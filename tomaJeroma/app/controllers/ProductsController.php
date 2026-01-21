<?php
    require_once('../app/models/ProductsRepository.php');
    require_once('../app/models/AttributesRepository.php');

    class ProductsController{

        public function index(){
            $repo = new ProductsRepository();
            $products = $repo->getProducts();
            View::render("list-product", ["products"=>$products]);
        }


        public function show() {
            View::render('product');
        }
    }
?>