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

CoursePage::$scheduleCourses = coursesDAO::getScheduleCourse();

if (!empty($_POST)) {
    $courseId = $_POST['inputCourse'];
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
    $course = CoursesDAO::getCourses();
    CoursePage::showResult($course);
}

// course submit

if(isset($_POST['courseSubmit'])) {
    if(!empty($_POST['courseList'])) {
        foreach ($_POST['courseList'] as $$courseId) {
            CoursesDAO::addCourses($courseId);
        }

        // header("Location: calendar.php");
    }
}

CoursePage::footer();
?>