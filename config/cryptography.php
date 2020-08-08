<?php 

    // Store the cipher method 
    //$this->ciphering = "AES-128-CTR"; 
    define('CIPHERING', "AES-128-CTR");

    // Use OpenSSl Encryption method 
    //$this->iv_length = openssl_cipher_iv_length($this->ciphering);
    define('IV_LENGTH', openssl_cipher_iv_length(CIPHERING));
    //$this->options = 0; 
    define('OPTIONS',0);

    // Non-NULL Initialization Vector for encryption 
   //$this->iv = '1234567891011121'; //gyzyklanmaly
    define('IV', '1234567891011121');

   // $this->key = "GeekSpace";
    define('KEY', 'Geekspace');

?>