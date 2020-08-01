<?php
include_once("../inc/config.inc.php");
require_once("../inc/entity/User.class.php");
include_once("../inc/entity/Courses.class.php");
include_once("../inc/entity/Page_course.class.php");

include_once("../inc/utility/PDOAgent.class.php");
require_once("../inc/utility/LoginManager.class.php");
include_once("../inc/utility/coursesDAO.class.php");
require_once("../inc/utility/UserDAO.class.php");

coursesDAO::init("Courses");
UserDAO::init();

CoursePage::header();

// get all schedule
session_start();

if(!isset($_SESSION['loggedin'])) {

    header("Location: userLogin.php");
    exit;
}

coursesDAO::$studentId = $_SESSION['loggedin'];
$u = UserDAO::getUser($_SESSION['loggedin']);

CoursePage::userInfo($u);
CoursePage::showSearchBar();

foreach(coursesDAO::getScheduleCourse() as $scheduleCourse) {
    CoursePage::$scheduleCourses[] = $scheduleCourse->getCourseID();
}

if (!empty($_POST)) {
    $courseId = (int)$_POST['inputCourse'];
    if (!empty($courseId)) {
        $courses = coursesDAO::getSingleCourse($courseId);
        CoursePage::showResult([$courses]);
    } else {
        $major = $_POST['major'];
        $term = $_POST['term'];

        if(!empty($major) && !empty($term)) {
            $courses = coursesDAO::getSelectedCourses($major, $term);
            CoursePage::showResult($courses);
        }
    }
} else {
    $courses = coursesDAO::getCourses();
    CoursePage::showResult($courses);
}

// course submit

if(isset($_POST['courseSubmit'])) {
    $courseList = $_POST['courseList'];
    if(!empty($courseList)) {
        foreach ($courseList as $courseId) {
            try {
                coursesDAO::addCourses($courseId);
                $course = coursesDAO::getSingleCourse($courseID);
                CoursePage::showCourses($course);
            }
            catch(Exception $e){
                throw "Failed to add course. Please check if it's already added";
            }
           
        }
        
    }
}

CoursePage::footer();
?>