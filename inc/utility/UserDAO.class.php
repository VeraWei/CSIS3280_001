<?php

class UserDAO   {

    private static $db;

    static function init()  {
        //Initialize the internal PDO Agent
        self::$db = new PDOAgent("User");    
    }    

    static function getUser(int $studentId)  {

        try {
            $selectOne = "SELECT * FROM Student WHERE studentId=$studentId";
    
            self::$db->query($selectOne);
            self::$db->execute();

        } catch(PDOException $pe) {
            error_log($pe->getMessage());
        }
        
        return self::$db->singleResult();
    }

}