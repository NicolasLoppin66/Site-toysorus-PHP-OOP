<?php

namespace App\Models;

use Core\Models;

class Toys extends Models
{
    public string $name;

    public string $description;

    public int $brand_id;

    public float $price;

    public string $image;

    public string $slug;
}