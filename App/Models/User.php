<?php

namespace App\Models;

use Core\Models;

class User extends Models
{
    public const ROLE_SUBCRIBER = 1;

    public const ROLE_ADMINISTRATOR = 2;

    public string $email;

    public string $password;

    public int $role;
}