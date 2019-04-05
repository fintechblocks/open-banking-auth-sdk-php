# PHP-SDK #

## What is Open Bankig Auth PHP-SDK? ##

This SDK provides tools for the integration of the Open Banking authorization flow into your PHP application.

This repository contains two subfolders:
* */OpenBankingAuth* contains the SDK source code 
* */examples* contains an example on how to use the SDK

## How to use this SDK ##

First read throught the Authorization part of API documentation.

[Account-information API documentation](<exampleOpenBankingApiUrl>/api-documentation/account-info-1.0)

[Payment-initiation API documentation](<exampleOpenBankingApiUrl>/api-documentation/payment-init-1.0)

**Usage**

```php
include_once(BASE_PATH . DIRECTORY_SEPARATOR."OpenBankingAuth".DIRECTORY_SEPARATOR."OpenBankingAuth.php");
...
$example = new OpenBankingAuth([
            'client_assertion_type' => '...jwt-bearer',
            'scope' => 'accounts',
            'authorizationEndpoint' => 'auth url',
            'tokenEndpoint' => 'token endpoint',
            'redirect_uri' => 'your application's url,
            'grant_type' => 'check the documentation',
            'client_id' => your client id,
            'private_key' => 'your private key',
            'scope' => 'check the documentation',
            'base_url' => 'the base url',
            'api_base_url' => 'api base url',
            'x-fapi-customer-ip-address' => 'your IP address'
        ]);
```

### Get an access-token ###

**getAccessToken():String**

**Usage**

```php
$accessTokenObj = $example->getAccessToken();
```

### Generate authorization url ###

**generateAuthorizationURL(String $intentId):String**

*Required parameters*

* $intentId (identification of previously created intent, e.g. ConsentId)

**Usage**

```php
$authUrl = $example->generateAuthorizationURL($intentId);
```

### Exhange authorization code to tokens ###

**tokenExcange(String $code):object**

*Required parameters*

* $code (the authorization code received from the authorization server)

**Usage**

```php
$accesAndRefreshToken = $example->tokenExcange($code);
```

## Extra functionality ##

### Create signature header ###

**createSignatureHeader(String $body, String $keyid, String $issuer):String**

*Required parameters*

* $body (intent, e.g. an account-request)
* $keyid
* $issuer

**Usage**
```php
$requestBody = new stdClass();
$requestBody->Data = new stdClass();
$requestBody->Data->Permissions = [""];
$requestBody->Data->ExpirationDateTime = "2019-08-02T00:00:00+00:00";
$requestBody->Data->TransactionFromDateTime = "2017-05-03T00:00:00+00:00";
$requestBody->Risk = new stdClass();
$kid = "12asf54as2g12sa5"
$issuer = "";
$signatureHeader = $example->createSignatureHeader($requestBody, $kid, $issuer);
```

### Check if a token is expired ###

**isTokenExpired(String $token, int $expiredAfterSeconds):boolean**

*Required parameters*

* $token

*Optional parameters*

* $expiredAfterSeconds (number of seconds * 1000)

**Usage**

```php
$example->isTokenExpired($token,5000) // will the token expire after five seconds?
```

### Use a refresh token ###

**refreshToken(String $refreshToken):Object**

*Required parameters*

* $token (refresh token)

**Usage**

```php
$newTokens = $example->refreshToken($refreshToken);
```

## How to run the example ##

You only need a Apache and php. 