<?php

namespace App\Entity;

class Author
{
    public $name;
    public $surname;
    public $birthDate;
    public $country;

    public function __construct($name, $surname, $birthDate, $country)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->birthDate = $birthDate;
        $this->country = $country;
    }

    public function getInfo()
    {
        return [
            'name'=>$this->name,
            'surname'=>$this->surname,
            'birth_data'=>$this->birthDate,
            'country'=>$this->country
        ];
    }
}