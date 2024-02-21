<?php

namespace App\Controller;

use Nette\Database\DriverException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class RateController
{
    public function list(Request $request): JsonResponse
    {
        global $connect;
        $data = $connect->getPdo()->query("select * from `rate`")->fetchAll(\PDO::FETCH_ASSOC) ?: [];
        return new JsonResponse($data, 200);
    }

    /**
     * @throws DriverException
     */
    public function update(Request $request): JsonResponse
    {
        global $connect;
        $params = $request->toArray();
        $connect->query("INSERT INTO rate (`from`, `to`, `rate`) VALUES ('{$params['from']}', '{$params['to']}',{$params['rate']}) ON DUPLICATE KEY UPDATE rate={$params['rate']}")->fetch();
        return new JsonResponse([], 200);
    }
}

