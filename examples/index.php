<?php
    session_start();
    error_reporting(E_ERROR | E_PARSE);
    ini_set('max_execution_time', 300);
    define('BASE_PATH', dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR);
    if (isset($_GET["logout"])) {
        session_destroy();
        header("location:./index.php");
    }
    //Example "mode" parameters -- accounts
    $modeArray["accounts"]["client_id"] = "<exampleAppclication>@account-info-1.0";
    $modeArray["accounts"]["base_url"] = "<exampleOpenBankingApiUrl>/account-info-1.0/open-banking/v3.1/aisp";
    $modeArray["accounts"]["scope"] = "accounts";

    //Example "mode" parameters -- payments
    $modeArray["payments"]["client_id"] = "<exampleAppclication>@payment-init-1.0";
    $modeArray["payments"]["base_url"] = "<exampleOpenBankingApiUrl>/payment-init-1.0/open-banking/v3.1/pisp";
    $modeArray["payments"]["scope"] = "payments";
 
    //"Logout" link -- remove sessions
    echo "<a style='position:absolute;right:5px;' href='index.php?logout'>Logout</a>";
    //There are two "modes" in this example app (Accounts and Payments)
    if (isset($_GET["example_function"]) || isset($_SESSION["example_function"])){
        if (isset($_GET["example_function"])) {
            $_SESSION["example_function"] = $_GET["example_function"];
        }
        
        include_once(BASE_PATH . DIRECTORY_SEPARATOR."OpenBankingAuth".DIRECTORY_SEPARATOR."OpenBankingAuth.php"); //The main class
        include_once(".".DIRECTORY_SEPARATOR."src".DIRECTORY_SEPARATOR."Functions.php"); // A collection of API functions
        include_once(".".DIRECTORY_SEPARATOR."src".DIRECTORY_SEPARATOR."Connect.php"); //A simple class to create the cUrl calls. You can use your own as well.

        //Set the "OpenBankingAuth" class parameters 
        $example = new OpenBankingAuth([
            'client_assertion_type' => 'urn:ietf:params:oauth:client-assertion-type:jwt-bearer',
            'scope' => 'accounts',
            'authorizationEndpoint' => '<exampleOpenBankingApiUrl>/auth/realms/ftb-sandbox/protocol/openid-connect/auth',
            'tokenEndpoint' => '<exampleOpenBankingApiUrl>/auth/realms/ftb-sandbox/protocol/openid-connect/token',
            'redirect_uri' => 'http://localhost/',
            'grant_type' => 'client_credentials',
            'client_id' => $modeArray[$_SESSION['example_function']]['client_id'],
            'private_key' => file_get_contents(".".DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'keys'.DIRECTORY_SEPARATOR.'rsa.pem'),
            'scope' => $modeArray[$_SESSION['example_function']]['scope'],
            'base_url' => $modeArray[$_SESSION['example_function']]['base_url'],
            'api_base_url' => '<exampleOpenBankingApiUrl>/auth/realms',
            'x-fapi-customer-ip-address' => '127.0.0.1:8080'
        ]);
        
        //Set the "Functions" class parameters (example class)
        $functions = new Functions([
            "base_url" => $modeArray[$_SESSION["example_function"]]["base_url"],
            "api_base_url" => "<exampleOpenBankingApiUrl>/auth/realms"
        ]);

        if (!isset($_GET["code"]) && (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"])) {
            //Get access_token
            $accessToken = $example->getAccessToken();
            $_SESSION["accessToken"] = $accessToken;

            //Get accountAccessConsentId - create payload
            if ($_SESSION["example_function"] == "accounts") {
                $requestBody = new stdClass();
                $requestBody->Data = new stdClass();
                $requestBody->Data->Permissions = ["ReadAccountsBasic", "ReadAccountsDetail", "ReadBalances", "ReadBeneficiariesBasic", "ReadBeneficiariesDetail", "ReadDirectDebits","ReadProducts","ReadStandingOrdersBasic","ReadStandingOrdersDetail", "ReadTransactionsDetail", "ReadTransactionsCredits", "ReadTransactionsDebits"];
                $requestBody->Data->ExpirationDateTime = "2019-08-02T00:00:00+00:00";
                $requestBody->Data->TransactionFromDateTime = "2017-05-03T00:00:00+00:00";
                $requestBody->Risk = new stdClass();
                $_SESSION["kid"] = $functions->generateRandomString().$functions->generateRandomString();
                $issuer = "C=UK, ST=England, L=London, O=Acme Ltd.";
                $signatureHeader = $example->createSignatureHeader($requestBody, $_SESSION["kid"], $issuer);
                $intentId = $functions->createAccountAccessConsent($requestBody, $accessToken, ["Content-Type: application/json","x-jws-signature:".$signatureHeader]);
            } else {
                $requestBody = new stdClass();
                $requestBody->Data = new stdClass();
                $requestBody->Data->Initiation = new stdClass();
                $requestBody->Data->Initiation->InstructionIdentification = "ACME412";
                $requestBody->Data->Initiation->EndToEndIdentification = "FRESCO.21302.GFX.20";
                $requestBody->Data->Initiation->InstructedAmount = new stdClass();
                $requestBody->Data->Initiation->InstructedAmount->Amount = "165.88";
                $requestBody->Data->Initiation->InstructedAmount->Currency = "HUF";
                $requestBody->Data->Initiation->CreditorAccount = new stdClass();
                $requestBody->Data->Initiation->CreditorAccount->SchemeName = "IBAN";
                $requestBody->Data->Initiation->CreditorAccount->Identification = "HU14120103740010183300300001";
                $requestBody->Data->Initiation->CreditorAccount->Name = "ACME Inc";
                $requestBody->Data->Initiation->CreditorAccount->SecondaryIdentification = "0002";
                $requestBody->Data->Initiation->RemittanceInformation = new stdClass();
                $requestBody->Data->Initiation->RemittanceInformation->Reference = "FRESCO-101";
                $requestBody->Data->Initiation->RemittanceInformation->Unstructured = "Internal ops code 5120101";
                $requestBody->Risk = new stdClass();

                $xIdempotencyKey = $functions->generateRandomString();
                $issuer = "C=UK, ST=England, L=London, O=Acme Ltd.";
                $signatureHeader = $example->createSignatureHeader($requestBody, $_SESSION["kid"], $issuer);
                $intentId = $functions->createPaymentRequest($requestBody, $accessToken,["Content-Type: application/json","x-idempotency-key: ".$xIdempotencyKey, "x-jws-signature:".$signatureHeader]);
                $_SESSION["example_payment_id"] = $intentId;
            }
            if ((!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"])) {
                //You need to redirect the user to the bank interface
                $authUrl = $example->generateAuthorizationURL($intentId);
                header("Location: $authUrl");
            }
        }
        //Get the code from the portal
        if (isset($_GET["code"]) && (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"])){
            if (!isset($_SESSION["user_access_token"]) || $_SESSION["user_access_token"] == "") {
                $assertionPayload = [
                    "sub" => $example->config["client_id"],
                    "aud" => $example->config["api_base_url"]."/ftb-sandbox/protocol/openid-connect/token",
                    "exp" => 1575504000,
                ];

                $example->config["code"] = $_GET["code"];
                $example->config["grant_type"] = "authorization_code";
                $example->config["client_assertion"] = $_SESSION["clientAssertion"];
                $accesAndRefreshToken = $example->tokenExcange($_GET["code"]);
                $userAccessToken = $accesAndRefreshToken->access_token;
                $example->config["user_access_token"] = $userAccessToken;
                $_SESSION["user_access_token"] = $userAccessToken;
            }
            $_SESSION["code"] = $_GET["code"];
            $_SESSION["loggedIn"] = true;
        }
        switch($_SESSION["example_function"]) {
            case "accounts":
                include_once("accountsExample.php");
            break;
            case "payments":
                include_once("paymentsExample.php");
            break;
        }
    } else {
        echo "<a href='?example_function=accounts'>Accounts Example</a><br />";
        echo "<a href='?example_function=payments'>Payments Example</a><br />";
    }
?>