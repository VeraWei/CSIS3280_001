<?php
include_once("../inc/config.inc.php");
require_once("../inc/entity/User.class.php");
include_once("../inc/entity/Courses.class.php");
include_once("../inc/entity/Page_course.class.php");

include_once("../inc/utility/PDOAgent.class.php");
require_once("../inc/utility/LoginManager.class.php");
include_once("../inc/utility/CoursesDAO.class.php");
require_once("../inc/utility/UserDAO.class.php");

CoursesDAO::init();
UserDAO::init();

CoursePage::header();

// get all schedule
session_start();

if(!isset($_SESSION['loggedin'])) {

    header("Location: userLogin.php");
    exit;
}

CoursesDAO::$studentId = $_SESSION['loggedin'];
$u = UserDAO::getUser($_SESSION['loggedin']);

CoursePage::userInfo($u);
CoursePage::showSearchBar();

foreach(CoursesDAO::getScheduleCourse() as $scheduleCourse) {
    CoursePage::$scheduleCourses[] = $scheduleCourse->getCourseID();
}

if (!empty($_POST)) {
    if (!empty($_POST['inputCourse'])) {
        $courses = CoursesDAO::getSingleCourse((int)$_POST['inputCourse']);
        CoursePage::showResult([$courses]);
    } else {

        if(!empty($_POST['major']) && !empty($_POST['major'])) {
            $courses = CoursesDAO::getSelectedCourses($_POST['major'], $_POST['term']);
            CoursePage::showResult($courses);
        }
    }
} else {
    $courses = CoursesDAO::getCourses();
    CoursePage::showResult($courses);
}

// course submit

if(isset($_POST['courseSubmit'])) {
    if(!empty($_POST['courseList'])) {
        foreach ($_POST['courseList'] as $courseId) {
            try {
                CoursesDAO::addCourses($courseId);
                // $course = CoursesDAO::getSingleCourse($courseID);
                // CoursePage::showCourses($course);

            }
            catch(Exception $e){
                throw "Failed to add course. Please check if it's already added";
            }
           
        }

        header("Location: schedule.php");
        exit;
        
    }
}

CoursePage::footer();
?>