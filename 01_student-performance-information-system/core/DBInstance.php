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
                "host" => "localhost",
                "port" => 3306,
                "dbname" => "systech_student-performance-information-system",
                "charset" => "utf8mb4"
            ],
            "root",
            "2611"
        );
    }

    // The object is not cloneable.
    private function __clone()
    {
    }

    // The static method that controls access to the singleton instance.
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new DBInstance();
        }

        return self::$instance;
    }
}
