<?php
    class Category{
        public $id;
        public $name;
        public $description;

        public function getId() {
            return $this->id;
        }
        public function getName() {
            return $this->name;
        }
        public function getDescription() {
            return $this->description;
        }
    }
?>