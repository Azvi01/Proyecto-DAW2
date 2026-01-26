<?php
    require_once('../app/models/ProductsRepository.php');
    require_once('../app/models/AttributesRepository.php');
    require_once("../app/models/CategoryRepository.php");


    class ProductsController{

        public function products(){
            $repo = new ProductsRepository();
            $products = ["products"=>$repo->getProducts()];
            $this->index($products);
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

            $this->index($data);
        }

        public function showProductCategory() {
            $categoryID = $_GET['categoryId'] ?? '';
            $repo = new ProductsRepository();
            $products = ["products"=>$repo->getProductByCategory($categoryID)];
            if (!$products['products']) {
                Session::set("error","Error al cargar los productos de esa categoria, puede que no exista.");
                header("Location: index.php");
                exit;
            }
            $this->index($products);
        }

        public function showProductOffer() {
            $repo = new ProductsRepository();
            $products = ["products"=>$repo->getProductInOffer()];
            if (!$products) {
                View::render("list-product", ["error"=>"No hay produtos en oferta"]);
                exit;
            }
            $this->index($products);
        }

        public function search() {
            $texto = $_POST['buscar'] ?? '';

            if (!$texto) {
                
            }
        }

        public function index($products) {
            $repo = new CategoryRepository();
            $categories = $repo->getCategories();

            if (isset($products['attrs'])) {
                View::render('product', [
                    "attrs"=>$products['attrs'],
                    "product"=>$products['product'],
                    "categories"=>$categories
                ]);
            }else{
                View::render("list-product", [
                    "products"=>$products['products'],
                    "categories"=>$categories
                    ]);
            }
        }
    }
?>