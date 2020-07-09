<?php

namespace App\Services;

    class ConnectionService{
        private static $conn = null;

        private static function setConn(){
            Self::$conn = new \PDO("mysql:host=localhost;dbname=adopet", "root", "");            
        }

        public static function connect(){
            if(is_null(Self::$conn))
                Self::setConn();
            
            return Self::$conn;
        }
    }

?>