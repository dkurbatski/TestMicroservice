<?php

namespace App\Validation;

use Symfony\Component\HttpFoundation\JsonResponse;

class GetAuthorValidation
{
    public static function validate(
        ?string $name,
        ?string $surname,
        ?string $birth_date,
        ?string $country
    ): array
    {
        if (!$name || !$surname || !$country || !$birth_date) {
            return ['error' => 'Wrong params'];
        }
        if (strlen($surname) < 2) {
            return ['error' => 'Wrong length surname'];
        }
        if (strlen($name) < 2) {
            return ['error' => 'Wrong length name'];
        }
        return [];
    }
}