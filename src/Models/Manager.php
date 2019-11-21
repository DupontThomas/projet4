<?php
namespace App\Models;

use PDO;

class Manager
{
    function dbConnect()
    {
        try {
            $db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
            return $db;
        } catch(Exception $e) {
            die('Erreur : '.$e->getMessage());
        }

        mysql_query('SET NAMES "UTF8"');
    }
}

