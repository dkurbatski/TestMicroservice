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
        $birth_date=$request->get('birth_date');
        $country=$request->get('country');
        if ($error = GetAuthorValidation::validate($name, $surname,$birth_date,$country)) {
            return new JsonResponse($error);
        }
        global $connect;
        $connect->query("INSERT IGNORE `author`(`name`,`surname`,`birth_date`,`country`) values (?, ?, ?, ?)", $name, $surname, $birth_date, $country)->fetch();
        return new JsonResponse([
            'name' => $name,
            'surname' => $surname,
            'country'=>$country,
            'birth_date'=>$birth_date
        ]);
    }
}