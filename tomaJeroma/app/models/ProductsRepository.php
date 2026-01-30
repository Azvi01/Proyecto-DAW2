<?php
require_once('../app/libs/Model.php');
require_once('../app/models/Product.php');

class ProductsRepository extends Model
{

    public function getProducts()
    {
        $sql = "
                SELECT
                    p.id,
                    p.name,
                    p.description,
                    p.base_price,
                    p.img,
                    p.category_id,
                    p.fabricante,
                    p.stock,

                    o.id    AS offers_id,
                    o.name  AS offers_name,
                    o.type  AS offers_type,
                    o.value AS offers_value,

                    c.name  AS category_name
                FROM products p
                LEFT JOIN offers_products op
                    ON p.id = op.product_id
                LEFT JOIN offers o
                    ON op.offer_id = o.id
                LEFT JOIN category c
                    ON p.category_id = c.id
                WHERE p.active = 1;
            ";
        try {
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'Product');
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function getProduct($id)
    {
        $sql = "
                SELECT
                    p.id,
                    p.name,
                    p.description,
                    p.base_price,
                    p.img,
                    p.category_id,
                    p.fabricante,
                    p.stock,

                    o.id    AS offers_id,
                    o.name  AS offers_name,
                    o.type  AS offers_type,
                    o.value AS offers_value,

                    c.name  AS category_name
                FROM products p
                LEFT JOIN offers_products op
                    ON p.id = op.product_id
                LEFT JOIN offers o
                    ON op.offer_id = o.id
                LEFT JOIN category c
                    ON p.category_id = c.id
                WHERE p.id = :id;
            ";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);

            return $stmt->fetchObject('Product');
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function getProductByCategory($categoryId)
    {
        $sql = "
                SELECT
                    p.id,
                    p.name,
                    p.description,
                    p.base_price,
                    p.img,
                    p.category_id,
                    p.fabricante,
                    p.stock,

                    o.id    AS offers_id,
                    o.name  AS offers_name,
                    o.type  AS offers_type,
                    o.value AS offers_value,

                    c.name  AS category_name
                FROM products p
                LEFT JOIN offers_products op
                    ON p.id = op.product_id
                LEFT JOIN offers o
                    ON op.offer_id = o.id
                LEFT JOIN category c
                    ON p.category_id = c.id
                WHERE c.id = :id ;
            ";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $categoryId]);
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'Product');
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function getProductInOffer()
    {
        $sql = "
                SELECT
                    p.id,
                    p.name,
                    p.description,
                    p.base_price,
                    p.img,
                    p.category_id,
                    p.fabricante,
                    p.stock,

                    o.id    AS offers_id,
                    o.name  AS offers_name,
                    o.type  AS offers_type,
                    o.value AS offers_value,

                    c.name  AS category_name
                FROM products p
                RIGHT JOIN offers_products op
                    ON p.id = op.product_id
                LEFT JOIN offers o
                    ON op.offer_id = o.id
                LEFT JOIN category c
                    ON p.category_id = c.id
            ";
        try {
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'Product');
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function getProductByFilter($filter)
    {
        $sql = "
                SELECT
                    p.id,
                    p.name,
                    p.description,
                    p.base_price,
                    p.img,
                    p.category_id,
                    p.fabricante,
                    p.stock,

                    o.id    AS offers_id,
                    o.name  AS offers_name,
                    o.type  AS offers_type,
                    o.value AS offers_value,

                    c.name  AS category_name
                FROM products p
                LEFT JOIN offers_products op
                    ON p.id = op.product_id
                LEFT JOIN offers o
                    ON op.offer_id = o.id
                LEFT JOIN category c
                    ON p.category_id = c.id
                WHERE p.name LIKE :filter ;
            ";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute(["filter" => "%" . $filter . "%"]);
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'Product');
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function addProduct($name, $description, $price, $category_id, $fabricante, $stock)
    {
        $sql = "INSERT INTO products (name, description, base_price, category_id, fabricante, stock) 
            VALUES (?, ?, ?, ?, ?, ?)";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$name, $description, $price, $category_id, $fabricante, $stock]);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteProduct($id)
    {
        $sql = "UPDATE products SET active = 0 WHERE id = ?";
        try {
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function getProductsByAdvancedFilter($categoryId = null, $stockStatus = null, $searchTerm = '')
    {
        $sql = "SELECT p.*, c.name AS category_name FROM products p 
            LEFT JOIN category c ON p.category_id = c.id WHERE p.active = 1";
        $params = [];

        if (!empty($searchTerm)) {
            $sql .= " AND p.name LIKE ?";
            $params[] = "%$searchTerm%";
        }

        if (!empty($categoryId)) {
            $sql .= " AND p.category_id = ?";
            $params[] = $categoryId;
        }

        if ($stockStatus === 'in_stock') {
            $sql .= " AND p.stock > 0";
        } elseif ($stockStatus === 'out_of_stock') {
            $sql .= " AND p.stock <= 0";
        }

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'Product');
        } catch (PDOException $e) {
            return [];
        }
    }

    public function updateProduct($id, $name, $description, $price, $category_id, $fabricante, $stock, $img = null)
    {
        $sql = "UPDATE products SET name=?, description=?, base_price=?, category_id=?, fabricante=?, stock=?";
        $params = [$name, $description, $price, $category_id, $fabricante, $stock];

        if ($img) {
            $sql .= ", img=?";
            $params[] = $img;
        }

        $sql .= " WHERE id=?";
        $params[] = $id;

        try {
            $stmt = $this->db->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
