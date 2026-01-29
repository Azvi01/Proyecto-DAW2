<?php
require_once('../app/libs/Model.php');

class AdminRepository extends Model {

    public function getTotalSales() {
        $sql = "SELECT SUM(total) as total FROM orders WHERE status = 'paid'";
        $stmt = $this->db->query($sql);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res['total'] ?? 0;
    }


    public function getTotalOrders() {
        $sql = "SELECT COUNT(*) as total FROM orders";
        $stmt = $this->db->query($sql);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res['total'] ?? 0;
    }

    public function getRecentOrders() {
        $sql = "SELECT o.*, u.mail FROM orders o 
                LEFT JOIN users u ON o.user_id = u.id 
                ORDER BY o.order_date DESC LIMIT 5";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}