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
        $fromPrice = $request->get('from_price');
        $toPrice = $request->get('to_price');
        $orderBy = $request->get('order_by');
        $orderDirection = $request->get('order_direction');
        if (!in_array($orderBy, ["brand", "model", "odometer", "year"]) || !in_array($orderDirection, ["asc", "desc"])) {
            return new JsonResponse(["error" => "Wrong params"], 422);
        }
        if ($currency) {
            $sql = "SELECT auto.id as id, brand, model, odometer, year, price_amount*r.rate as price_amount, r.to as price_currency, is_actual
FROM auto
join rate r on r.`from`=auto.price_currency
where r.`to`='$currency'";
            if ($odometer) {
                $sql .= " and odometer<$odometer";
            }
            if ($fromPrice) {
                $sql .= " and price_amount*r.rate=>$fromPrice";
            }
            if ($toPrice) {
                $sql .= " and price_amount*r.rate<=$toPrice";
            }
        } else {
            $sql = "select * from `auto`";
            if ($odometer) {
                $sql .= " where odometer<$odometer";
            }
            if ($fromPrice) {
                $sql .= " where fromPrice=>$fromPrice";
            }
            if ($toPrice) {
                $sql .= " where toPrice<=$toPrice";
            }
        }
        if ($orderBy){
            $sql.=" ORDER BY '$orderBy' ".($orderDirection ?: "asc");
        }
        var_dump($sql);
        die();
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

