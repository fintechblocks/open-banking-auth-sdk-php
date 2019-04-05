<?php
    include_once("src".DIRECTORY_SEPARATOR."createJWT.php");
    include_once("src".DIRECTORY_SEPARATOR."OpenBankingAuthConnect.php");
    /**
    * Example usage:
    * $example = new OpenBankingAuth([
    *        'param' => 'value',
    *        'param' => 'value',
    *    ]);
    *
    * @author   Zoltan Baksa <zoltan.baksa@fintechblocks.com>
    * @version  1.0
    * @access   public
    */
    class OpenBankingAuth {
        public $config;
        public function __construct(array $config = []) {
            $this->config = array_merge([
                "redirect_uri" => "",
                "authorizationEndpoint" => "",
                "tokenEndpoint" => "",
                "client_assertion" => "",
                "client_assertion_type" => "",
                "scope" => "",
                "grant_type" => "",
                "private_key" => "",
                "access_token" => "",
                "account_access_consent_id"=>"",
                "client_id" => "",
                "code" => "",
                "base_url" => "",
                "api_base_url" => "",
                "x-fapi-customer-ip-address" => "",
                "key_id" => ""
            ], $config);
        }
        /**
         * Create a JWT from the payload (the JWT's body) array 
         * @param array $payload
         * @return string
         */
        private function getClientAssertion(){
            $assertionPayload = [
                "sub" => $this->config["client_id"],
                "aud" => $this->config["tokenEndpoint"],
                "exp" => time()+60000,
            ];
            $JWT = new createJWT();
            return $JWT->getJWT($assertionPayload, $this->config["private_key"]);
        }

        /**
         * Create a Access token
         * @return object - the full response from the server
         */
        public function getAccessToken(){
            $postArray = [
                "grant_type" => $this->config["grant_type"],
                "scope" => $this->config["scope"],
                "client_assertion_type" => $this->config["client_assertion_type"],
                "client_assertion" => $this->getClientAssertion()
            ];
            $connect =  new OpenBankingAuthConnect([
                "url" => $this->config["tokenEndpoint"],
                "header" => ["Content-Type: application/x-www-form-urlencoded"],
                "post" => http_build_query($postArray)
            ]);
            $response = json_decode($connect->getResponse());
            return $response->access_token;
        }
        /**
         * Generate the auth url 
         * @param int $intentId 
         * @return string - url 
         */
        public function generateAuthorizationURL($intentId){
            //Open Bank interface
            $payload = new stdClass();
            $payload->client_id = $this->config["client_id"];
            $payload->redirect_uri = $this->config["redirect_uri"];
            $payload->claims = new stdClass();
            $payload->claims->userinfo = new stdClass();
            $payload->claims->userinfo->openbanking_intent_id = new stdClass();
            $payload->claims->userinfo->openbanking_intent_id->value = $intentId;
            $payload->claims->id_token = new stdClass();
            $payload->claims->id_token->openbanking_intent_id = new stdClass();
            $payload->claims->id_token->openbanking_intent_id->value = $intentId;

            $JWT = new createJWT();
            $request = $JWT->getJWT((array) $payload,$this->config["private_key"]);
            $url = $this->config["authorizationEndpoint"]."?response_type=code&client_id=".$this->config['client_id']."&redirect_uri=".$this->config['redirect_uri']."&scope=".$this->config['scope']."&request=".$request;
            return $url;
        }

        /**
         * Get the new tokens from the server
         * @return object - with the access, and refresh tokens
         */
        public function tokenExcange($code) {
            $assertion = $this->getClientAssertion();
            $postArray = [
                "client_assertion" => $assertion,
                "client_assertion_type" => "urn:ietf:params:oauth:client-assertion-type:jwt-bearer",
                "code" => $code,
                "grant_type" => "authorization_code",
                "redirect_uri" => $this->config["redirect_uri"]];
            $connect =  new OpenBankingAuthConnect([
                "url" => $this->config["tokenEndpoint"],
                "header" => ["Content-Type: application/x-www-form-urlencoded"],
                "post" => http_build_query($postArray)
            ]);
            $response = json_decode($connect->getResponse());
            $responseObj = new stdClass();
            $responseObj->access_token = $response->access_token;
            $responseObj->refresh_token = $response->refresh_token;
            return $responseObj;
        }

        /**
         * Create the x-jws-signature
         * @param array $body
         * @param string $keyId
         * @param string $issuer
         * @return string - the JWT header and footer, without the body
         */
        public function createSignatureHeader($body, $keyId, $issuer) {
            $header = [
                "alg" => "RS256",
                "kid" => $keyId,
                "b64" => false,
                "http://openbanking.org.uk/iat" => time(),
                "http://openbanking.org.uk/iss" => $issuer,
                "crit" => ["b64", "http://openbanking.org.uk/iat", "http://openbanking.org.uk/iss"]
            ];
            $JWT = new createJWT();
            $request = $JWT->createSignatureHeader($body, $this->config["private_key"], $keyId, $header);
            $reqArr = explode(".", $request);
            return $reqArr[0]."..".$reqArr[2];
        }

        /**
         * Get new access and refresh tokens 
         * @param string $refresh_token
         * @return object - contains the full response 
         */
        public function refreshToken($refresh_token){
            $postArray = [
                "grant_type" => "refresh_token",
                "refresh_token" => $refresh_token,
                "scope" => "accounts",
                "client_assertion_type" => "urn:ietf:params:oauth:client-assertion-type:jwt-bearer",
                "client_assertion" => $this->getClientAssertion()
            ];
            
            $connect =  new OpenBankingAuthConnect([
                "url" => $this->config["tokenEndpoint"],
                "header" => ["Content-Type: application/x-www-form-urlencoded"],
                "post" => http_build_query($postArray)
            ]);
            $response = json_decode($connect->getResponse());
            return $response;
        }
        /**
         * Check if the token is expired
         * @param string $token - remember, if you want to check a JWT-s expiration, you need to set here the payload (explode the JWT by ".")
         * @param int $expiredAfterSeconds 
         * @return bool
         */
        public function isTokenExpired($token, $expiredAfterSeconds = 0){
            $tokenBody = json_decode(base64_decode($token));
            $expiration = $tokenBody->exp;
            $now = time();
            if ($expiredAfterSeconds == 0) {
                $now += $expiredAfterSeconds;
            }
            return $expiration < $now;
        }
    }
?>