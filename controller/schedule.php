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
// initial DAO
CoursesDAO::init();
UserDAO::init();

// display the schedule page header
SchedulePage::header();

// get all schedule
session_start();

// if the user's status is loggin 
if(!isset($_SESSION['loggedin'])) {

    header("Location: userLogin.php");
    exit;
}
// display the student info 
CoursesDAO::$studentId = $_SESSION['loggedin'];
$u = UserDAO::getUser($_SESSION['loggedin']);

CoursePage::userInfo($u);


//get the courseID from URL
if (!empty($_GET['crn'])){
	CoursesDAO::deleteSchedule($_GET['crn']);

} 
  
//get all schedule courses form database
$courses = CoursesDAO::getScheduleCourse();

// if there is no record in database
if (empty($courses)) {
	// display placeholder
	SchedulePage::showPlaceholder();
} else {
	foreach($courses as $course) {
		$fullCourseContent = CoursesDAO::getSingleCourse($course->getCourseID());
		SchedulePage::$courses[] = $fullCourseContent;
	}
	SchedulePage::showCourses();
}



SchedulePage::footer();