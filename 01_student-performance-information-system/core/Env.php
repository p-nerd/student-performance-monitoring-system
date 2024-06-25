<?php

namespace Core;

class Env
{
    public static function load()
    {
    }

    public static function get(string $key)
    {
        return getenv($key);
    }
}
