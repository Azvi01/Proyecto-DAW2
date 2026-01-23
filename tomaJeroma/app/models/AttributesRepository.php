<?php
    require_once '../app/libs/Database.php';
    require_once("../app/libs/Model.php");
    require_once '../app/models/Attributes.php';

    class AttributesRepository extends Model{
        public function getAttrProduct() {
            $sql = "
                SELECT 
                    a.name AS atributo,
                    av.value AS valor,
                    a.unit AS unidad
                FROM product_attr_value pa
                INNER JOIN att_value av ON pa.att_id = av.id
                INNER JOIN attributes a ON av.att_id = a.id
                WHERE pa.product_id = :id;
            ";

            // try {
            //     $stmt = $this->db->prepare($sql);

            // } catch (\PDOException $e) {
            //     error_log($e->getMessage());
            //     return [];
            // }
        }
    }
?>