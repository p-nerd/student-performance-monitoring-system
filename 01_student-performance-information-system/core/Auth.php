<?php

namespace Core;

use App\Services\User;

class Auth
{
    protected const COOKIE_KEY = "auth";

    public static function login(int $user_id)
    {
        $key = self::generateKey();
        self::setCookie($key);
        self::setSession($key, ["user_id" => $user_id]);
    }

    public static function user(DB $db): null|false|array
    {
        $data = self::data();
        if (!$data) {
            return null;
        }
        if (!$data["user_id"]) {
            return null;
        }
        return User::find($db, $data["user_id"]);
    }

    public static function logout()
    {
        $key = self::getCookie();
        if (!$key) {
            return;
        }
        self::destroySession($key);
        self::destroyCookie();
    }

    protected static function data(): ?array
    {
        $key = self::getCookie();
        if (!$key) {
            return null;
        }
        return self::getSession($key);
    }

    protected static function generateKey(): string
    {
        $random_bytes = random_bytes(16);
        return hash('sha256', $random_bytes);
    }

    protected static function setCookie(string $value)
    {
        $expire = time() + 30 * 24 * 60 * 60; // 30 days * 24 hours * 60 minutes * 60 seconds
        setcookie(self::COOKIE_KEY, $value, $expire, '/');
    }

    protected static  function getCookie()
    {
        if (!isset($_COOKIE[self::COOKIE_KEY])) {
            return null;
        }
        return $_COOKIE[self::COOKIE_KEY];
    }

    protected static function destroyCookie()
    {
        if (isset($_COOKIE[self::COOKIE_KEY])) {
            setcookie(self::COOKIE_KEY, '', time() - 3600, '/');
        }
    }

    protected static function setSession(string $key, array $data)
    {
        $_SESSION[$key] = $data;
    }

    protected static function getSession(string $key): ?array
    {
        return $_SESSION[$key];
    }


    protected static function destroySession(string $key)
    {
        $_SESSION[$key] = null;
    }
}
