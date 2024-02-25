<?php

namespace App\Controller;

use App\Action\GetAutoListAction;
use Nette\Database\DriverException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AutoController
{
    /**
     * @throws DriverException
     */
    public function list(Request $request): JsonResponse
    {
        $params = $request->request->all();
        return new JsonResponse(
            [
                'auto' => (new GetAutoListAction())(
                    $params['currency'] ?? null,
                    $params['odometer'] ?? null,
                    $params['from_price'] ?? null,
                    $params['to_price'] ?? null,
                    $params['order_by'] ?? null,
                    $params['order_direction'] ?? null
                )
            ],
            200
        );
    }

    /**
     * @throws DriverException
     */
    public function add(Request $request): JsonResponse
    {
        global $connect;
        $params = $request->toArray();
        $connect->query("insert into auto (brand, model, odometer, year, price_amount, price_currency) VALUES ('{$params['brand']}', '{$params['model']}',{$params['odometer']}, {$params['year']}, {$params['price_amount']}, '{$params['price_currency']}')")->fetch();
        return new JsonResponse([], 200);
    }
}

