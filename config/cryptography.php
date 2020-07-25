<?php 

    class Cryptography {

        public function __construct(){
            // Store the cipher method 
            $this->ciphering = "AES-128-CTR"; 
  
            // Use OpenSSl Encryption method 
            $this->iv_length = openssl_cipher_iv_length($this->ciphering); 
            $this->options = 0; 
  
            // Non-NULL Initialization Vector for encryption 
            $this->iv = '1234567891011121'; //gyzyklanmaly

            $this->key = "GeekSpace";
        }

        public function encrypt($sample){
            return openssl_encrypt($sample, $this->ciphering, 
                        $this->key, $this->options, $this->iv); 
        }

        public function decrypt($sample){
            return openssl_decrypt($sample, $this->ciphering, 
                        $this->key, $this->options, $this->iv); 
        }

    }

?>