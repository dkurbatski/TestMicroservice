<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class PhoneController
{
    public function info(Request $request)
    {
        global $connect;
        $phone = $request->get('phone');
        $countryCode = $request->get('country_code');
        $data = $connect->query("select * from phones where e164='$phone'");
        if (!$data) {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', "https://api-bdc.net/data/phone-number-validate?number=$phone&countryCode=$countryCode&key={$_ENV['BIG_DATA_CLOUD_API_KEY']}");

            $dataFromJson = json_decode($response->getBody(), true); // '{"id": 1420053, "name": "guzzle", ...}'
            if (!$dataFromJson['isValid']) {
                return new JsonResponse(['error' => 'phone not valid'], 422);
            }
            $data=[
                'e164'=>$dataFromJson['e164Format'],
                'is_valid'=>$dataFromJson['isValid'],
                'international'=>$dataFromJson['internationalFormat'],
                'national'=>$dataFromJson['nationalFormat'],
                'location'=>$dataFromJson['location'],
                'type'=>$dataFromJson['lineType'],
                'country_alpha2'=>$dataFromJson['countryAlpha2']['isoAlpha2'],
                'country_alpha3'=>$dataFromJson['countryAlpha3']['isoAlpha3']
            ];
        }

        return new JsonResponse($data, 200);
    }
}