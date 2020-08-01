<?php

//  id | full_name | username  | password
class User{

    // attributes
    private $id = 0;
    private $username = '';
    private $full_name = '';
    private $password = '';

    // Getter
    function getId() : int{
        return $this->id;
    }
    function getUserName() : string{
        return $this->username;
    }
    function getFullName() : string{
        return $this->full_name;
    }

    // function to verify user password
    function verifyPassword(string $passwordInput){
        return password_verify($passwordInput, $this->password);
    }

}

?>