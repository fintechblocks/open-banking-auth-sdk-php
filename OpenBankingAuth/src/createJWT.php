<?php
    include(dirname(__DIR__).'..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'php-jwt-master'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'JWT.php');
    use \Firebase\JWT\JWT;
    class createJWT {
        public function getJWT($body, $privateKey){
            $jwt = JWT::encode($body, $privateKey, 'RS256');
            return $jwt;
        }

        public function createSignatureHeader($body, $privateKey, $keyId, $header){
            $jwt = JWT::encode($body, $privateKey, "RS256", $keyId, $header);
            return $jwt;
        }
    }

?>