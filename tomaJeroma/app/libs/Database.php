<?php

    class Database {
        private static $instance = null;
        private PDO $pdo;

        private function __construct() {

            $dsn = "mysql:host=db;dbname=eCommerce;charset=utf8mb4";

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            try {
                
                $this->pdo = new PDO($dsn, "prueba", "root", $options);
                
            } catch (PDOException $e) {
                error_log("Error Crítico de BBDD: " . $e->getMessage());
                
                throw new Exception("No se pudo conectar al gestor de base de datos.");
            }
        }

        public static function getInstance() {
            if (self::$instance === null) {
                self::$instance = new Database();
            }
            return self::$instance;
        }


        public function getPDO() {
            return $this->pdo;
        }

        private function __clone() { }
    }
?>