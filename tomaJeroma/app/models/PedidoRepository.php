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

    

    public function getAllOrdersWithUser($clientId = null) {
    $sql = "SELECT o.*, u.mail as user_email 
            FROM orders o 
            LEFT JOIN users u ON o.user_id = u.id";
    $params = [];

    if (!empty($clientId)) {
        $sql .= " WHERE o.user_id = ?";
        $params[] = $clientId;
    }

    $sql .= " ORDER BY o.order_date DESC";

    try {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        error_log($e->getMessage());
        return [];
    }
}
}
?>