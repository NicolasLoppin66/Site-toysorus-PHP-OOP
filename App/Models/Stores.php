<?php

namespace App\Models;

use Core\Models;

class Stores extends Models
{
    public string $name;
    
    public string $city;

    public int $postal_code;

}