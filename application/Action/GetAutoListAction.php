<?php

namespace App\Action;

use App\Validation\GetAutoListValidation;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetAutoListAction
{
    public function __invoke(
        ?string $currency = null,
        ?string $odometer = null,
        ?string $fromPrice = null,
        ?string $toPrice = null,
        ?string $orderBy = null,
        ?string $orderDirection = null
    )
    {
        if ($error = (new GetAutoListValidation())->validate($orderBy, $orderDirection)) {
            return new JsonResponse($error, 422);
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
        if ($orderBy) {
            $sql .= " ORDER BY '$orderBy' " . ($orderDirection ?: "asc");
        }
        global $connect;
        return $connect->query($sql)->fetchAll();
    }
}