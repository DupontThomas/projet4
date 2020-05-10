<?php
namespace App\Models;

use PDO;

class Manager
{
    function dbConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
        return $db;
    }
}

