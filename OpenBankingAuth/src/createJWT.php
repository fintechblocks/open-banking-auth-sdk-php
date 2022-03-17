<?php
    include(dirname(__DIR__).DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'php-jwt-master'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php');
    use Firebase\JWT\JWT;

    class createJWT {
        public function getJWT($body, $privateKey){
            return JWT::encode($body, $privateKey, 'RS256');
        }

        public function createSignatureHeader($body, $privateKey, $keyId, $header){
            return JWT::encode($body, $privateKey, "RS256", $keyId, $header);
        }
    }
