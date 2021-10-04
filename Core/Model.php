<?php 

namespace Core;

use PDO;
use App\Config;

abstract class Model {

    protected static function getDB() {

        static $db = null;

        if ($db === null) {
            
            try {

                $db = new PDO('mysql:host='.Config::DB_HOST.';dbname='.Config::DB_NAME.';charset=utf8', 
                            Config::DB_USER, Config::DB_PASSWORD);
    
            } catch (PDOException $e) { 

                echo $e->getMessage(); 
            }
        }

        return $db;
    }
}