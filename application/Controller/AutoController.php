<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AutoController
{
    public function list(Request $request): JsonResponse
    {
        global $connect;
        $data = $connect->query("select * from `auto`")->fetchAll();
        return new JsonResponse(['auto' => $data], 200);
    }

    public function add(Request $request)
    {
        global $connect;
        $params = $request->toArray();
        $connect->query("insert into auto (brand, model, odometer, year, price_amount, price_currency) VALUES ('{$params['brand']}', '{$params['model']}',{$params['odometer']}, {$params['year']}, {$params['price_amount']}, '{$params['price_currency']}')")->fetch();
        return new JsonResponse([], 200);
    }
}

