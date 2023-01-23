<?php

namespace Core;

class SessionManager
{
    // Pour pouvoir alimenter notre session
    public static function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    // Pour récupérer la session
    public static function get(string $key)
    {
        if (!isset($_SESSION[$key]))
            return null;
        return $_SESSION[$key];
    }

    // Pour vider la session
    public static function remove(string $key): void
    {
        if (!self::get($key))
            return;
        unset($_SESSION[$key]);
    }
}