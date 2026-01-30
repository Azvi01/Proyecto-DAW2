<?php
require_once '../app/models/AdminRepository.php';
require_once('../app/models/ProductsRepository.php');
require_once '../app/models/CategoryRepository.php';


class AdminController
{

    public function index()
    {

        // if (JWTToken::rescueUserRole(Session::get('UserToken')) !== 'admin') { header('Location: index.php'); }

        $repo = new AdminRepository();

        $data = [
            'ventasTotales' => $repo->getTotalSales(),
            'totalPedidos' => $repo->getTotalOrders(),
            'pedidosRecientes' => $repo->getRecentOrders()
        ];


        View::render('dashboard', ["data" => $data]);
    }

    public function products()
    {
        $repoProd = new ProductsRepository();
        $repoCat = new CategoryRepository();

        $productos = $repoProd->getProducts();
        $categorias = $repoCat->getCategories();

        View::render("dashboard/products_management", [
            "productos" => $productos,
            "categories" => $categorias
        ]);
    }

    public function search()
    {
        $texto = $_POST['buscar'] ?? '';
        $repo = new ProductsRepository();

        if (!$texto) {
            View::render("dashboard/products_management", ['error' => "Debes introducir algo"]);
            exit;
        }

        $products = $repo->getProductByFilter($texto);
        if (!$products) {
            View::render("dashboard/products_management", ['error' => "No se ha encontrado un producto con el nombre $texto"]);
            exit;
        }

        View::render("dashboard/products_management", ["productos" => $products]);
    }

    public function saveProduct()
    {
        $id = !empty($_POST['id']) ? intval($_POST['id']) : null;
        $name = trim($_POST['name'] ?? '');
        $desc = trim($_POST['description'] ?? '');
        $price = floatval($_POST['price'] ?? 0);
        $cat = !empty($_POST['category_id']) ? intval($_POST['category_id']) : null;
        $fab = trim($_POST['fabricante'] ?? '');
        $stock = isset($_POST['stock']) ? intval($_POST['stock']) : -1;

        // Validación de seguridad
        if (empty($name) || empty($fab) || empty($desc) || $price <= 0 || $stock < 0 || !$cat) {
            Session::set('error', "Por favor, rellena todos los campos correctamente.");
            header("Location: index.php?controller=Admin&action=products");
            exit;
        }

        $repo = new ProductsRepository();

        if ($id) {

            $imgName = $this->handleImageUpload($id);


            $result = $repo->updateProduct($id, $name, $desc, $price, $cat, $fab, $stock, $imgName);

            if ($result !== false) {
                Session::set('error', "Producto actualizado con éxito.");
            } else {
                Session::set('error', "Error técnico al intentar actualizar.");
            }
        } else {

            if (!isset($_FILES['img']) || $_FILES['img']['error'] !== UPLOAD_ERR_OK) {
                Session::set('error', "La imagen es obligatoria para nuevos productos.");
                header("Location: index.php?controller=Admin&action=products");
                exit;
            }

            $newId = $repo->addProduct($name, $desc, $price, $cat, $fab, $stock);
            if ($newId) {
                $imgName = $this->handleImageUpload($newId);
                $repo->updateProduct($newId, $name, $desc, $price, $cat, $fab, $stock, $imgName);
                Session::set('error', "Producto creado con éxito.");
            } else {
                Session::set('error', "No se pudo crear el producto en la base de datos.");
            }
        }
        header("Location: index.php?controller=Admin&action=products");
        exit;
    }

    private function handleImageUpload($id)
    {
        if (!isset($_FILES['img']) || $_FILES['img']['error'] !== UPLOAD_ERR_OK) return null;

        $fileTmpPath = $_FILES['img']['tmp_name'];
        $fileName = $_FILES['img']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($fileExtension, $allowedExtensions)) {
            $destPath = "./img/products/" . $id . "." . $fileExtension;
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                return $destPath;
            }
        } else {
            Session::set('error', "Formato de la imagen incorrecto");
            header("Location: index.php?controller=Admin&action=products");
            exit;
        }
    }

    public function deleteProduct()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $repo = new ProductsRepository();
            if ($repo->deleteProduct($id)) {
                Session::set('error', "Producto desactivado correctamente.");
            } else {
                Session::set('error', "No se pudo desactivar el producto.");
            }
        }
        header("Location: index.php?controller=Admin&action=products");
        exit;
    }

    public function filter()
    {
        $texto = $_GET['buscar'] ?? '';
        $catId = $_GET['category'] ?? null;
        $stock = $_GET['stock'] ?? null;

        $repoProd = new ProductsRepository();
        $repoCat = new CategoryRepository();

        $productos = $repoProd->getProductsByAdvancedFilter($catId, $stock, $texto);
        $categorias = $repoCat->getCategories();

        View::render("dashboard/products_management", [
            "productos" => $productos,
            "categories" => $categorias
        ]);
    }
}
