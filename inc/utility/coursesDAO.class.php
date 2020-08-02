<?php
class CoursesDAO {
    private static $db;
    public static $studentId;
    
    static function init() {
        self::$db = new PDOAgent("Courses");
    }

    static function getSingleCourse(int $courseId) {
        $sql = "SELECT * FROM Courses WHERE courseId = :id;";
        self::$db->query($sql);
        self::$db->bind(":id", $courseId);
        self::$db->execute();
        return self::$db->singleResult();
    }

    static function getSelectedCourses(string $major, string $term) {
        $sqlSeleted = "SELECT * FROM Courses WHERE major = :major AND term = :term";
        self::$db->query($sqlSeleted);
        self::$db->bind(":major", $major);
        self::$db->bind(":term", $term);
        self::$db->execute();
        return self::$db->getResultSet();
    }

    static function getCourses() {
        $sqlAll = "SELECT * FROM Courses";
        self::$db->query($sqlAll);
        self::$db->execute();
        return self::$db->getResultSet();
    }

    static function addCourses($courseId) {

        $sqlInsert = "INSERT INTO Schedule VALUES(:courseId, :studentId);";

        self::$db->query($sqlInsert);
        self::$db->bind(':courseId', (int)$courseId);
        self::$db->bind(':studentId', self::$studentId);
        self::$db->execute();
    }

    static function getScheduleCourse() {
        $sqlAll = "SELECT * FROM Schedule WHERE studentId = :studentId";

        self::$db->query($sqlAll);
        self::$db->bind(':studentId', self::$studentId);
        self::$db->execute();
        return self::$db->getResultSet();
    }

    static function deleteSchedule() {

        $studentId = $_SESSION['loggedin'];
        $deleteQuery = "DELETE FROM Schedule WHERE studentId = :studentId And courseId = :courseId;";
    
        self::$db->query($deleteQuery);
        self::$db->bind(':studentId', $studentId);
        self::$db->bind(':courseId', $_GET["crn"]);

        self::$db->execute();

        if(self::$db->rowCount() != 1){
            $errorMsg = "Problem deleting course registration";
            error_log($errorMsg);
        }    
    }
}


?>