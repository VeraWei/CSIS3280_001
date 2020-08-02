<?php

require_once("../inc/config.inc.php");
require_once("../inc/entity/User.class.php");
require_once("../inc/entity/Page.class.php");

require_once("../inc/utility/LoginManager.class.php");
require_once("../inc/utility/PDOAgent.class.php");
require_once("../inc/utility/UserDAO.class.php");

//Display login page header
Page::header();
//Initialize the DAO
UserDAO::init();


//Check if the form was posted
if (!empty($_POST['studentId']))   {

    
    $authUser = UserDAO::getUser($_POST['studentId']);

        //Check authUser is exsist and  the password is correct
        if ($authUser && $authUser->verifyPassword($_POST['password']))  {

            //Start the session
            session_start();
            
            //Set the user to logged in
            $_SESSION['loggedin'] = $authUser->getStudentId();
            
        } else {
            // or display the error
            Page::showError();
        }
}

if (LoginManager::verifyLogin())    {
    
    header("Location: courseDetail.php");
    exit;
}
else
    Page::showLogin();

Page::footer();


?>