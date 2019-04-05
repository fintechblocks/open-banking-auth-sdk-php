<?php
/* */
class Functions {
    private $config;
    public function __construct(array $config) {
        $this->config = $config;
    }
    public function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
    
    /*************************************************************** ACCOUNT FUNCTIONS *****************************************************************/
    public function createAccountAccessConsent($body, $access_token, $header){
        $header = array_merge([
            "Authorization: Bearer ".$access_token
        ], $header);
        $connect =  new Connect([
            "url" => $this->config["base_url"]."/account-access-consents",
            "header" => $header,
            "post" => json_encode($body)
        ]);
        $response = json_decode($connect->getResponse());
        return $response->Data->ConsentId;
    }

    public function getAccounts($userAccessToken){
        $connect =  new Connect([
            "url" => $this->config["base_url"]."/accounts",
            "header" => ["Authorization: Bearer ".$userAccessToken,"Content-Type: application/json","x-fapi-customer-ip-address: 127.0.0.1:8080"]
        ]);
        $response = json_decode($connect->getResponse());
        return $response;
    }
    
    public function getAccountByAccountId($userAccessToken, $accountId) {
        $connect =  new Connect([
            "url" => $this->config["base_url"]."/accounts/".$accountId,
            "header" => ["Authorization: Bearer ".$userAccessToken,"Content-Type: application/json","x-fapi-customer-ip-address: 127.0.0.1:8080"]
        ]);
        $response = json_decode($connect->getResponse());
        return $response;
    }
    
    public function getTransactions($userAccessToken){
        $connect =  new Connect([
            "url" => $this->config["base_url"]."/transactions",
            "header" => ["Authorization: Bearer ".$userAccessToken,"Content-Type: application/json","x-fapi-customer-ip-address: 127.0.0.1:8080"]
        ]);
        $response = json_decode($connect->getResponse());
        return $response;
    }
    
    public function getTransactionsByAccountId($userAccessToken, $accountId){
        $connect =  new Connect([
            "url" => $this->config["base_url"]."/accounts/".$accountId."/transactions",
            "header" => ["Authorization: Bearer ".$userAccessToken,"Content-Type: application/json","x-fapi-customer-ip-address: 127.0.0.1:8080"]
        ]);
        $response = json_decode($connect->getResponse());
        return $response;
    }
    
    public function getBeneficiaries($userAccessToken) {
        $connect =  new Connect([
            "url" => $this->config["base_url"]."/beneficiaries",
            "header" => ["Authorization: Bearer ".$userAccessToken,"Content-Type: application/json","x-fapi-customer-ip-address: 127.0.0.1:8080"]
        ]);
        $response = json_decode($connect->getResponse());
        return $response;
    }
    
    public function getBeneficiariesByAccountId($userAccessToken, $accountId) {
        $connect =  new Connect([
            "url" => $this->config["base_url"]."/accounts/".$accountId."/beneficiaries",
            "header" => ["Authorization: Bearer ".$userAccessToken,"Content-Type: application/json","x-fapi-customer-ip-address: 127.0.0.1:8080"]
        ]);
        $response = json_decode($connect->getResponse());
        return $response;
    }
    
    public function getBalances($userAccessToken) {
        $connect =  new Connect([
            "url" => $this->config["base_url"]."/balances",
            "header" => ["Authorization: Bearer ".$userAccessToken,"Content-Type: application/json","x-fapi-customer-ip-address: 127.0.0.1:8080"]
        ]);
        $response = json_decode($connect->getResponse());
        return $response;
    }
    
    public function getBalancesByAccountId($userAccessToken, $accountId){
        $connect =  new Connect([
            "url" => $this->config["base_url"]."/accounts/".$accountId."/balances",
            "header" => ["Authorization: Bearer ".$userAccessToken,"Content-Type: application/json","x-fapi-customer-ip-address: 127.0.0.1:8080"]
        ]);
        $response = json_decode($connect->getResponse());
        return $response;
    }
    
    public function getDirectDebits($userAccessToken){
        $connect =  new Connect([
            "url" => $this->config["base_url"]."/direct-debits",
            "header" => ["Authorization: Bearer ".$userAccessToken,"Content-Type: application/json","x-fapi-customer-ip-address: 127.0.0.1:8080"]
        ]);
        $response = json_decode($connect->getResponse());
        return $response;
    }
    
    public function getDirectDebitsByAccountId($userAccessToken, $accountId){
        $connect =  new Connect([
            "url" => $this->config["base_url"]."/accounts/".$accountId."/direct-debits",
            "header" => ["Authorization: Bearer ".$userAccessToken,"Content-Type: application/json","x-fapi-customer-ip-address: 127.0.0.1:8080"]
        ]);
        $response = json_decode($connect->getResponse());
        return $response;
    }
    
    public function getStandingOrders($userAccessToken){
        $connect =  new Connect([
            "url" => $this->config["base_url"]."/standing-orders",
            "header" => ["Authorization: Bearer ".$userAccessToken,"Content-Type: application/json","x-fapi-customer-ip-address: 127.0.0.1:8080"]
        ]);
        $response = json_decode($connect->getResponse());
        return $response;
    }
    
    public function getStandingOrdersByAccountId($userAccessToken, $accountId){
        $connect =  new Connect([
            "url" => $this->config["base_url"]."/accounts/".$accountId."/standing-orders",
            "header" => ["Authorization: Bearer ".$userAccessToken,"Content-Type: application/json","x-fapi-customer-ip-address: 127.0.0.1:8080"]
        ]);
        $response = json_decode($connect->getResponse());
        return $response;
    }

    /*************************************************************** PAYMENT FUNCTIONS *****************************************************************/
    public function createPaymentRequest($body, $access_token, $header){
        $header = array_merge([
            "Authorization: Bearer ".$access_token
        ], $header);
        $connect =  new Connect([
            "url" => $this->config["base_url"]."/domestic-payment-consents",
            "header" => $header,
            "post" => json_encode($body)
        ]);
        $response = json_decode($connect->getResponse());
        return $response->Data->ConsentId;
    }

    public function getPaymentById($userAccessToken, $paymentId){
        $connect =  new Connect([
            "url" => $this->config["base_url"]."/domestic-payment-consents/".$paymentId,
            "header" => ["Authorization: Bearer ".$userAccessToken,"Content-Type: application/json","x-fapi-customer-ip-address: 127.0.0.1:8080"]
        ]);
        $response = json_decode($connect->getResponse());
        return $response;
    }
}
?>