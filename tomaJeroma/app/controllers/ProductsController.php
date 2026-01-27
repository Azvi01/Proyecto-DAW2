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
                $this->index(['error'=>"No hay producots en oferta."]);
                exit;
            }
            $this->index($products);
        }

        public function search() {
            $texto = $_POST['buscar'] ?? '';
            $repo = new ProductsRepository();

            if (!$texto) {
                Session::set("error","Error al buscar un producto, no puedes dejarlo vacio.");
                header("Location: index.php");
                exit;
            }

            $products = $repo->getProductByFilter($texto);
            if (!$products) {
                $this->index(['error'=>"No se ha encontrado un producto con el nombre $texto"]);
                exit;
            }

            $this->index(["products"=>$products]);
        }

        public function index($products) {
            $repo = new CategoryRepository();
            $categories = $repo->getCategories();

            if (isset($products['error'])) {
                View::render('list-product', ["error"=>$products['error'], "categories"=>$categories]);
                exit;
            }

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