<?php

namespace App\Controllers;

interface ControllerInterface
{
    public static function redirect(
        string $url,
        int $status = 302,
        array $header = [],
    );
       
}