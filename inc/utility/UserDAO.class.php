<?php

class UserDAO   {

    private static $db;

    static function init()  {
        //Initialize the internal PDO Agent
        self::$db = new PDOAgent("User");    
    }    

    static function getUser(string $userName)  {
        
        $sql = "SELECT * FROM users WHERE username=:user";
        self::$db->query($sql);
        self::$db->bind(":user",$userName);
        self::$db->execute();
        
        return self::$db->singleResult();
    }

    static function setPassword($userName, $newPassword)    {
        return self::$db->rowCount();
    }

    static function getUsers()  {

           

    }
    
    
}