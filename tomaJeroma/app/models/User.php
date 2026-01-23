<?php
    class User{
        public $id;
        public $hashed_pass;
        public $mail;
        public $telf;
        public $role;
        public $logup_date;

        public function getHashed_pass() {
            return $this->hashed_pass;
        }
        public function getMail() {
            return $this->mail;
        }
        public function getTelf() {
            return $this->telf;
        }
        public function getRole() {
            return $this->role;
        }
        public function getId() {
            return $this->id;
        }
        public function getLogup_date() {
            return $this->logup_date;
        }
    }
?>