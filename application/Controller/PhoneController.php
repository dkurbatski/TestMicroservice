<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class PhoneController
{
    public function info(Request $request)
    {
        $phone=$request->get('phone');
        $countryCode=$request->get('country_code');
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', "https://api-bdc.net/data/phone-number-validate?number=$phone&countryCode=$countryCode&key={$_ENV['BIG_DATA_CLOUD_API_KEY']}");

        $data = json_decode($response->getBody(), true); // '{"id": 1420053, "name": "guzzle", ...}'
        return new JsonResponse($data, 200);
    }
}