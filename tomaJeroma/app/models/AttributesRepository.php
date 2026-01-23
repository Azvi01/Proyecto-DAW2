<?php
    require_once '../app/libs/Database.php';
    require_once("../app/libs/Model.php");
    require_once '../app/models/Attributes.php';

    class AttributesRepository extends Model{
        public function getAttrProduct($id) {
            $sql = "
                SELECT
                    a.id as id,
                    a.name AS attr_name,
                    av.value AS value,
                    a.unit AS unit
                FROM product_attr_value pa
                INNER JOIN att_value av ON pa.att_id = av.id
                INNER JOIN attributes a ON av.att_id = a.id
                WHERE pa.product_id = :id;
            ";

            try {
                $stmt = $this->db->prepare($sql);
                $stmt->execute([":id"=>$id]);

                return $stmt->fetchAll(PDO::FETCH_CLASS, 'Attributes');
            } catch (\PDOException $e) {
                error_log($e->getMessage());
                return [];
            }
        }
    }
?>