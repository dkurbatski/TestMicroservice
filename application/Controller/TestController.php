<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TestController
{
    public function example(Request $request): JsonResponse
    {
        return new JsonResponse(['example' => 'Hello world'], 200);
    }
}

