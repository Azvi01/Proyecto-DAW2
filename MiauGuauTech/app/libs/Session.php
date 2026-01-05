<?php 
    class Session{

        public static function init(){
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        }

        public static function set($key, $value){
            $_SESSION[$key] = $value;
        }

        public static function get($key){
            return $_SESSION[$key] ?? null;
        }

        public static function delete($key){
            if (isset($_SESSION[$key])) {
                unset($_SESSION[$key]);
            }
        }

        public static function destroy(){
            $_SESSION = [];
            session_destroy();
        }
    }
?>