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

        // 2. Validación estricta
        if (empty($name) || empty($fab) || empty($desc) || $price <= 0 || $stock < 0 || !$cat) {
            // Podrías guardar un mensaje de error en sesión aquí
            header("Location: index.php?controller=Admin&action=products&error=campos_incompletos");
            exit;
        }

        $repo = new ProductsRepository();

        if ($id) {
            $imgName = $this->handleImageUpload($id);
            $repo->updateProduct($id, $name, $desc, $price, $cat, $fab, $stock, $imgName);
            if ($imgName) {
                    Session::set('error',"Producto editado con exito.");
                    header("Location: index.php?controller=Admin&action=products");
                    exit;
                }else{
                    Session::set('error',"Producto no editado.");
                    header("Location: index.php?controller=Admin&action=products");
                    exit;
                }
        } else {
            // MODO NUEVO: Validar que la imagen sea obligatoria al crear
            if (!isset($_FILES['img']) || $_FILES['img']['error'] !== UPLOAD_ERR_OK) {
                header("Location: index.php?controller=Admin&action=products&error=imagen_obligatoria");
                exit;
            }

            $newId = $repo->addProduct($name, $desc, $price, $cat, $fab, $stock);
            if ($newId) {
                $imgName = $this->handleImageUpload($newId);
                $repo->updateProduct($newId, $name, $desc, $price, $cat, $fab, $stock, $imgName);

                if ($imgName) {
                    Session::set('error',"Producto creado con exito.");
                    header("Location: index.php?controller=Admin&action=products");
                    exit;
                }else{
                    Session::set('error',"Producto no creado.");
                    header("Location: index.php?controller=Admin&action=products");
                    exit;
                }
            }
        }
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
        }else{
            Session::set('error',"Formato de la imagen incorrecto");
            header("Location: index.php?controller=Admin&action=products");
            exit;
        }
        
    }

    public function deleteProduct()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            Session::set('error',"Error al borrar el producto no se encontro.");
            header("Location: index.php?controller=Admin&action=products");
            exit;
        }
        (new ProductsRepository())->deleteProduct($id);
        header("Location: index.php?controller=Admin&action=products");
    }
}
