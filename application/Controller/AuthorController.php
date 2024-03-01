<?php

namespace App\Controller;

use App\Validation\GetAuthorValidation;
use App\Validation\GetPhoneInfoValidation;
use PDO;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class AuthorController
{
    public function info(Request $request)
    {
        $surname = $request->get('surname');
        $name = $request->get('name');
        if ($error = GetAuthorValidation::validate($name, $surname)) {
            return new JsonResponse($error);
        }
        return new JsonResponse([
            'name'=>$name,
            'surname'=>$surname
        ]);
    }
}