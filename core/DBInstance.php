<?php

namespace Core;

use Core\DB;

class DBInstance
{
    private static $instance = null;
    public DB $db;

    private function __construct()
    {

        $this->db = new DB(
            [
                "host" => conf("db.mysql.host"),
                "port" => conf("db.mysql.port"),
                "dbname" => conf("db.mysql.name"),
                "charset" => "utf8mb4"
            ],
            conf("db.mysql.username"),
            conf("db.mysql.password"),
        );
    }

    private function __clone()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new DBInstance();
        }

        return self::$instance;
    }
}
