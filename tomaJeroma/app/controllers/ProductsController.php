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
            $attrRepo = new AttributesRepository();
            $productRepo = new ProductsRepository();

            $id = $_GET['id'] ?? '';

            $attrs = $attrRepo->getAttrProduct($id);
            $product = $productRepo->getProduct($id);

            if (!$product) {
                Session::set("error","Error al cargar el producto, puede que ese producto no exista.");
                header("Location: index.php");
                exit;
            }

            $data = [
                "product"=> $product,
                "attrs"=> $attrs
            ];

            View::render('product', $data);
        }
    }
?>