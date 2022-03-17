<?php

class Config {
    static $accountInfoClientId = '<exampleAppclication>@account-info-1.0';
    static $accountInfoBaseUrl = '<exampleOpenBankingApiUrl>/account-info-1.0/open-banking/v3.1/ais';
    static $accountInfoScope = 'accounts';

    static $paymentInitClientId = '<exampleAppclication>@payment-init-1.0';
    static $paymentInitBaseUrl = '<exampleOpenBankingApiUrl>/payment-init-1.0/open-banking/v3.1/pisp';
    static $paymentInitScope = 'payments';
    

    static $authorizationEndpoint = '<exampleOpenBankingApiUrl>/auth/realms/ftb-sandbox/protocol/openid-connect/auth';
    static $tokenEndpoint = '<exampleOpenBankingApiUrl>/auth/realms/ftb-sandbox/protocol/openid-connect/token';
    static $apiBaseUrl = '<exampleOpenBankingApiUrl>/auth/realms';
    static $redirectUri = 'http://127.0.0.1:8080/examples/index.php';
}
