<?php
    class Token {
        public static function generate(){
            return $_SESSION['_token'] = base64_encode(openssl_random_pseudo_bytes(32));
        }
        public static function check($token){
            if(isset($_SESSION['_token']) && $token === $_SESSION['_token']){
                unset($_SESSION['_token']);
                return true;
            }
            return false;
        }
    }
    class Login{
        public static function check($staff_id){
            if(isset($_SESSION['staff_id']) && $staff_id === $_SESSION['staff_id']){
                return true;
            }
            return false;
        }
    }
?>