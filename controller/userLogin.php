<?php

require_once("inc/config.inc.php");
require_once("inc/Entity/User.class.php");
require_once("inc/Entity/Page.class.php");

require_once("inc/Utility/LoginManager.class.php");
require_once("inc/Utility/PDOAgent.class.php");
require_once("inc/Utility/UserDAO.class.php");



//Set the page Title
Page::header();
//Initialize the DAO
UserDAO::init();

// set password for the demo user
//UserDAO::setPassword('week13','1234');

//Check if the form was posted
if (!empty($_POST['username']))   {

    
    $authUser = UserDAO::getUser($_POST['username']);

        //Check the password
        if ($authUser->verifyPassword($_POST['password']))  {

            //Start the session
            session_start();
            
            //Set the user to logged in
            $_SESSION['loggedin'] = $authUser->getUserName();
            
        }
}

if (LoginManager::verifyLogin())    {
    $u = UserDAO::getUser($_SESSION['loggedin']);
    Page::showUserDetails($u);
}
else
    Page::showLogin();

Page::footer();


?>