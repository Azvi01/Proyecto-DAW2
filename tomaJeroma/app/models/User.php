<?php
    class User{
        public $hashedPass;
        public $email;
        public $number;
        public $rol;

        public function getHashedPass() {
            return $this->hashedPass;
        }
        public function getEmail() {
            return $this->email;
        }
        public function getNumber() {
            return $this->number;
        }
        public function getRol() {
            return $this->rol;
        }
    }
?>