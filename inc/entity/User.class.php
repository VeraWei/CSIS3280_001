<?php

class User{

    // attributes
    private $id = 0;
    private $studentId;
    private $full_name;
    private $email;
    private $major;
    private $password;

    // Getter
    function getId() : int{
        return $this->id;
    }
    function getStudentId() : int{
        return $this->studentId;
    }
    function getFullName() : string{
        return $this->full_name;
    }
    function getEmail() : string{
        return $this->email;
    }
    function getMajor() : string{
        return $this->major;
    }

    // function to verify user password
    function verifyPassword(string $passwordInput){
        return password_verify($passwordInput, $this->password);
    }

}

?>