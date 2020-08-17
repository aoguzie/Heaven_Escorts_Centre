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

    class TokenLogin {
        public static function generate(){
            return $_SESSION['cus_token'] = base64_encode(openssl_random_pseudo_bytes(32));
        }
    }

    class TokenResetPass {
        public static function generate(){
            return $_SESSION['reset_pass_token'] = base64_encode(openssl_random_pseudo_bytes(32));
        }
    }

    class Login{
        public static function check($cus_id){
            if(isset($_SESSION['cus_id']) && $cus_id === $_SESSION['cus_id']){
                return true;
            }
            return false;
        }
    }
?>