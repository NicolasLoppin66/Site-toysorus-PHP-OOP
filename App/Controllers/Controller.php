<?php

namespace App\Controllers;

use App\App;
use App\Controllers\ControllerInterface;
use Laminas\Diactoros\Response\RedirectResponse;

abstract class Controller implements ControllerInterface
{
    public static function redirect(
        string $url,
        int $status = 302,
        array $header = []
    )
    {
        $response = new RedirectResponse($url, $status, $header);
        App::getApp()->getRouter()->getPublisher()->publish($response);
        die();
    }
}