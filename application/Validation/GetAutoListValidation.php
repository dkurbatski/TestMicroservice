<?php

namespace App\Validation;

use Symfony\Component\HttpFoundation\JsonResponse;

class GetAutoListValidation
{
    public function validate(
        ?string $orderBy,
        ?string $orderDirection
    )
    {
        if (($orderBy && !in_array($orderBy, ["brand", "model", "odometer", "year"])) || ($orderDirection && !in_array($orderDirection, ["asc", "desc"]))) {
            return ["error" => "Wrong params"];
        }
        return [];
    }
}