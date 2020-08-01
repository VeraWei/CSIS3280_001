<?php
require_once("inc/config.inc.php");
require_once("inc/Entity/Page.class.php");
require_once("inc/Entity/User.class.php");

require_once("inc/Utility/PDOAgent.class.php");
require_once("inc/Utility/LoginManager.class.php");
require_once("inc/Utility/UserDAO.class.php");

//Start the sesion... one last time!
session_start();

//Unset the data
unset($_SESSION);

//Destroy the sesison
session_destroy();

Page::header();
echo "<p>Thank you for your visit!</p>";
Page::footer();

?>