<?php

namespace App\Validation;

use Symfony\Component\HttpFoundation\JsonResponse;

class GetPhoneInfoValidation
{
    public static function validate(
        ?string $phone,
        ?string $countryCode
    ): array
    {
        if (!$phone || !$countryCode) {
            return ['error' => 'Wrong params'];
        }
        if (strlen($countryCode) != 2) {
            return ['error' => 'Wrong length country_code'];
        }
        return [];
    }
}