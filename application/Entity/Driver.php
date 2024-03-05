<?php

namespace App\Entity;

use App\Entity\Author;

class Driver extends Author
{
    public $category;

    public function getInfo()
    {
        return [
            'name' => $this->name,
            'surname' => $this->surname,
            'birth_data' => $this->birthDate,
            'country' => $this->country,
            'category' => $this->category
        ];
    }
}