<?php

namespace App\Validation;

use Symfony\Component\HttpFoundation\JsonResponse;

class GetAuthorValidation
{
    public static function validate(
        ?string $name,
        ?string $surname
    ): array
    {
        if (!$name || !$surname) {
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