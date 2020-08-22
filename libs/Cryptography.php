<?php 
/*
    all configurations are in config folder
*/

    class Cryptography {

        public static function encrypt($sample){
            return openssl_encrypt($sample, CIPHERING, KEY, OPTIONS, IV); 
        }

        public static function decrypt($sample){
            return openssl_decrypt($sample, CIPHERING, KEY, OPTIONS, IV); 
        }

    }

?>