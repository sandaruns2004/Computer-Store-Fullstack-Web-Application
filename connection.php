<?php

class Database{
    public static $connection;

    public static function setConnection(){
        if(!isset(Database::$connection)){
            Database::$connection = new mysqli("localhost","root","Sns2004#","estore","3306");
        }
    }

    public static function iud($q){
        Database::setConnection();
        Database::$connection->query($q);
    }

    public static function search($q){
        Database::setConnection();
        $result = Database::$connection->query($q);
        return $result;
    }
}

?>