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
    $courseId = (int)$_POST['inputCourse'];
    if (!empty($courseId)) {
        $courses = CoursesDAO::getSingleCourse($courseId);
        CoursePage::showResult([$courses]);
    } else {
        $major = $_POST['major'];
        $term = $_POST['term'];

        if(!empty($major) && !empty($term)) {
            $courses = CoursesDAO::getSelectedCourses($major, $term);
            CoursePage::showResult($courses);
        }
    }
} else {
    $courses = CoursesDAO::getCourses();
    CoursePage::showResult($courses);
}

// course submit

if(isset($_POST['courseSubmit'])) {
    $courseList = $_POST['courseList'];
    if(!empty($courseList)) {
        foreach ($courseList as $courseId) {
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