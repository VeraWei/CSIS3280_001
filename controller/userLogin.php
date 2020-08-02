<?php

require_once("../inc/config.inc.php");
require_once("../inc/entity/User.class.php");
require_once("../inc/entity/Page.class.php");

require_once("../inc/utility/LoginManager.class.php");
require_once("../inc/utility/PDOAgent.class.php");
require_once("../inc/utility/UserDAO.class.php");

//Set the page Title
Page::header();
//Initialize the DAO
UserDAO::init();

// set password for the demo user
//UserDAO::setPassword('week13','1234');

//Check if the form was posted
if (!empty($_POST['studentId']))   {

    
    $authUser = UserDAO::getUser($_POST['studentId']);

        //Check the password
        if ($authUser && $authUser->verifyPassword($_POST['password']))  {

            //Start the session
            session_start();
            
            //Set the user to logged in
            $_SESSION['loggedin'] = $authUser->getStudentId();
            
        } else {
            Page::showError();
        }
}

if (LoginManager::verifyLogin())    {
    // $u = UserDAO::getUser($_SESSION['loggedin']);
    // Page::showUserDetails($u);
    
    header("Location: courseDetail.php");
    exit;
}
else
    Page::showLogin();

Page::footer();


?>