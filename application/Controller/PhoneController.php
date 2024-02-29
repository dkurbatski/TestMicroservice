<?php

namespace App\Controller;

use App\Validation\GetPhoneInfoValidation;
use PDO;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class PhoneController
{
    public function info(Request $request)
    {
        global $connect;
        $phone = $request->get('phone');
        $countryCode = $request->get('country_code');
        if ($error = GetPhoneInfoValidation::validate($phone, $countryCode)) {
            return new JsonResponse($error);
        }
        $data = $connect->query("select * from phones where e164='$phone'")->fetch();
        if (!$data) {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', "https://api-bdc.net/data/phone-number-validate?number=$phone&countryCode=$countryCode&key={$_ENV['BIG_DATA_CLOUD_API_KEY']}");

            $dataFromJson = json_decode($response->getBody(), true); // '{"id": 1420053, "name": "guzzle", ...}'
            if (!$dataFromJson['isValid']) {
                return new JsonResponse(['error' => 'phone not valid'], 422);
            }
            $data = [
                'e164' => $dataFromJson['e164Format'],
                'is_valid' => $dataFromJson['isValid'] ? 1 : 0,
                'international' => $dataFromJson['internationalFormat'],
                'national' => $dataFromJson['nationalFormat'],
                'location' => $dataFromJson['location'],
                'type' => $dataFromJson['lineType'],
                'country_alpha2' => $dataFromJson['country']['isoAlpha2'],
                'country_alpha3' => $dataFromJson['country']['isoAlpha3']
            ];
            $connect->query("INSERT IGNORE `phones`(`e164`,`is_valid`,`international`,`national`,`location`,`type`,`country_alpha2`,`country_alpha3`) values ('{$data['e164']}',{$data['is_valid']},'{$data['international']}','{$data['national']}','{$data['location']}','{$data['type']}','{$data['country_alpha2']}','{$data['country_alpha3']}')")->fetch(PDO::FETCH_ASSOC);
        }
        return new JsonResponse($data, 200);
    }
}