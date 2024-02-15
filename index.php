<?php

use GuzzleHttp\Client;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$client = new Client();
$response = $client->request('GET', 'https://www.boredapi.com/api/activity');

//echo $response->getStatusCode(); // 200
//echo $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
if ($response->getStatusCode()==200){
    var_dump(json_decode($response->getBody(),true));
}

