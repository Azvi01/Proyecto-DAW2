<?php
require_once('../app/libs/Model.php');
require_once('../app/models/Pedido.php');

class PedidosRepository extends Model {

    public function save($userId, $total, $carrito, $productosRepo) {
        try {
            $this->db->beginTransaction();

            $sql = "INSERT INTO orders (user_id, order_date, status, total) VALUES (?, NOW(), 'paid', ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$userId, $total]);
            $orderId = $this->db->lastInsertId();

            foreach ($carrito as $id => $item) {
                $producto = $productosRepo->getProduct($id);
                $cantidad = $item['cantidad'];
                $precioUnitario = $producto->getFinalPrice();

                $sqlItem = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
                $stmtItem = $this->db->prepare($sqlItem);
                $stmtItem->execute([$orderId, $id, $cantidad, $precioUnitario]);

                if ($producto->getStockProduct() < $cantidad) {
                    throw new Exception("El producto ". $producto->getNameProduct(). " no tiene stock");
                }

                $nuevoStock = $producto->getStockProduct() - $cantidad;
                $sqlStock = "UPDATE products SET stock = ? WHERE id = ?";
                $stmtStock = $this->db->prepare($sqlStock);
                $stmtStock->execute([$nuevoStock, $id]);
            }

            $this->db->commit();
            return $orderId;

        } catch (PDOException $e) {
            $this->db->rollBack();
            error_log($e->getMessage());
            return false;
        }
    }

    public function getPedidosByUser($userId) {
        $sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Pedido');
    }
}
?>