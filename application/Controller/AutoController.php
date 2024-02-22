<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AutoController
{
    public function list(Request $request): JsonResponse
    {
        $currency = $request->get('currency');
        $odometer = $request->get('odometer');
        if ($currency) {
            $sql = "SELECT auto.id as id, brand, model, odometer, year, price_amount*r.rate as price_amount, r.to as price_currency, is_actual
FROM auto
join rate r on r.`from`=auto.price_currency
where r.`to`='$currency'";
            if ($odometer){
                $sql.=" and odometer<$odometer";
            }
        } else {
            $sql = "select * from `auto`";
            if ($odometer){
                $sql.=" where odometer<$odometer";
            }
        }
        global $connect;
        $data = $connect->query($sql)->fetchAll();
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

