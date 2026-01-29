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
                    ON p.category_id = c.id;
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
                WHERE c.id = :id;
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
            return $this->db->prepare($sql)->execute($params);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteProduct($id)
    {
        $sql = "DELETE FROM products WHERE id = ?";
        return $this->db->prepare($sql)->execute([$id]);
    }
}
