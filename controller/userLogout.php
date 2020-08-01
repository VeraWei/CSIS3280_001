<?php
require_once("../inc/config.inc.php");
require_once("../inc/entity/Page.class.php");
require_once("../inc/entity/User.class.php");

require_once("../inc/utility/PDOAgent.class.php");
require_once("../inc/utility/LoginManager.class.php");
require_once("../inc/utility/UserDAO.class.php");

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