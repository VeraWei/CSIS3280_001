<?php
include_once("../inc/config.inc.php");
require_once("../inc/entity/User.class.php");
include_once("../inc/entity/Courses.class.php");
include_once("../inc/entity/Page_course.class.php");

include_once("../inc/utility/PDOAgent.class.php");
require_once("../inc/utility/LoginManager.class.php");
include_once("../inc/utility/CoursesDAO.class.php");
require_once("../inc/utility/UserDAO.class.php");
//intial DAO
CoursesDAO::init();
UserDAO::init();

//show coursePage header
CoursePage::header();

// get all schedule
session_start();

// check session
if(!isset($_SESSION['loggedin'])) {

    header("Location: userLogin.php");
    exit;
}

//set studentID into CourseDAO
CoursesDAO::$studentId = $_SESSION['loggedin'];
//get current user
$u = UserDAO::getUser($_SESSION['loggedin']);
CoursePage::userInfo($u);

//display content
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