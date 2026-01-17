<?php
    require_once '../app/libs/Database.php';
    require_once("../app/libs/Model.php");
    require_once '../app/models/Category.php';

    class CategoryRepository extends Model{
        public function getCategories() {
            $sql = "SELECT * FROM category";

            try {
                $stmt = $this->db->query($sql);
                return $stmt->fetchAll(PDO::FETCH_CLASS, 'Category');
            } catch (PDOException $e) {
                error_log($e->getMessage());
                return [];
            }
            
        }
    }
?>