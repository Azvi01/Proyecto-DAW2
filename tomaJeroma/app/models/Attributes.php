<?php
    class Attributes{
        public $id;
        public $attr_name;
        public $value;
        public $unit;

        public function getId() { return $this->id; }
        public function getName() { return $this->attr_name; }
        public function getValue() { return $this->value; }
        public function getUnit() { return $this->unit; }
        
    }
?>