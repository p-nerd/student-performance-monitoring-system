<?php

namespace Core;

/**
 * Class Conf
 *
 * This class provides methods to retrieve configuration values from files.
 *
 * @package Core
 */
class Conf
{
    protected const BASE_DIR = __DIR__ . "/../conf/";

    /**
     * Retrieves a configuration value based on its dot-separated name.
     *
     * Example usage: Conf::get('db.mysql.host') will retrieve the 'host' value
     * from the 'mysql' section of the 'db' configuration file.
     *
     * @param string $name The dot-separated configuration name (e.g., 'file.section.key')
     * @return string|null The configuration value if found; null if not found or invalid format.
     */
    public static function get(string $name): ?string
    {
        $parts = explode(".", $name);

        if (count($parts) < 2) {
            return null;
        }

        $confFileName = $parts[0];
        $data = require static::BASE_DIR . "/$confFileName.php";

        // Traverse the array based on the parts
        for ($i = 1; $i < count($parts); $i++) {
            if (!isset($data[$parts[$i]])) {
                return null;
            }
            $data = $data[$parts[$i]];
        }

        return $data;
    }
}
