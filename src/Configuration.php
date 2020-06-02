<?php

namespace App;

class Configuration
{
    const DBNAME = "projet4";
    const HOST = "Localhost";
    const USERNAME = "root";
    const PASSWORD = "";
    const URL = "http://localhost/projet4/";

    public function url()
    {
        return self::URL;
    }

}