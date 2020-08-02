<?php
include_once("../inc/config.inc.php");
require_once("../inc/entity/User.class.php");
include_once("../inc/entity/Courses.class.php");
include_once("../inc/entity/Page_course.class.php");
include_once("../inc/entity/Page_schedule.class.php");

include_once("../inc/utility/PDOAgent.class.php");
require_once("../inc/utility/LoginManager.class.php");
include_once("../inc/utility/CoursesDAO.class.php");
require_once("../inc/utility/UserDAO.class.php");

CoursesDAO::init();
UserDAO::init();

SchedulePage::header();

// get all schedule
session_start();

if(!isset($_SESSION['loggedin'])) {

    header("Location: userLogin.php");
    exit;
}

CoursesDAO::$studentId = $_SESSION['loggedin'];
$u = UserDAO::getUser($_SESSION['loggedin']);

CoursePage::userInfo($u);

if ($_GET["route"]=="delete-registration"){
	// CoursesDAO::deleteRegistration();
	
	// unset($_GET["route"]);
	// // header('Location: CourseRegistration.php');
	// exit;
} 
  


$courses = CoursesDAO::getScheduleCourse();

foreach($courses as $course) {
	$fullCourseContent = CoursesDAO::getSingleCourse($course->getCourseID());
	SchedulePage::showCourses($fullCourseContent);
}



SchedulePage::footer();