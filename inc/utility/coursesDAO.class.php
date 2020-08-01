<?php
class coursesDAO {
    private static $db;
    public static $studentId;
    
    static function init() {
        self::$db = new PDOAgent("courses");
    }

    static function getSingleCourse(int $courseId) {
        $sql = "SELECT * FROM courses WHERE courseId = :id;";
        self::$db->query($sql);
        self::$db->bind(":id", $courseId);
        self::$db->execute();
        return self::$db->singleResult();
    }

    static function getSelectedCourses(string $major, string $term) {
        $sqlSeleted = "SELECT * FROM courses WHERE major = :major AND term = :term";
        self::$db->query($sqlSeleted);
        self::$db->bind(":major", $major);
        self::$db->bind(":term", $term);
        self::$db->execute();
        return self::$db->getResultSet();
    }

    static function getCourses() {
        $sqlAll = "SELECT * FROM courses";
        self::$db->query($sqlAll);
        self::$db->execute();
        return self::$db->getResultSet();
    }

    static function addCourses($courseId) {
        $sqlUpdate = "UPDATE schedule SET courseId = :courseId WHERE studentId = :studentId;";


        self::$db->query($sqlUpdate);
        self::$db->bind(':courseId', $courseId);
        self::$db->bind(':studentId', self::$studentId);
        self::$db->execute();
    }

    static function getScheduleCourse() {
        $sqlAll = "SELECT courseId FROM schedule WHERE studentId = :studentId";

        self::$db->query($sqlAll);
        self::$db->bind(':studentId', self::$studentId);
        self::$db->execute();
        return self::$db->getResultSet();
    }
}


?>