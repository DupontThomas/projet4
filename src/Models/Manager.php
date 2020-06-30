<?php
namespace App\Models;

use App\Configuration;
use PDO;

/**
 * Class Manager
 * @package App\Models
 */
class Manager
{
    /**
     * @return \PDO
     */
    function dbConnect()
    {
        $ddb = new PDO("mysql:host=" . Configuration::HOST . ";dbname=" . Configuration::DBNAME . ";charset=utf8", Configuration::USERNAME, Configuration::PASSWORD);
        return $ddb;
    }
}
