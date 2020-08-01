<?php
// +-------------+--------------+------+-----+---------+-------+
// | Field       | Type         | Null | Key | Default | Extra |
// +-------------+--------------+------+-----+---------+-------+
// | courseId    | int          | NO   | PRI | NULL    |       |
// | subjects    | varchar(50)  | YES  |     | NULL    |       |
// | instructor  | varchar(50)  | YES  |     | NULL    |       |
// | courseStart | time         | YES  |     | NULL    |       |
// | courseEnd   | time         | YES  |     | NULL    |       |
// | weekDate    | int          | YES  |     | NULL    |       |
// | place       | varchar(50)  | YES  |     | NULL    |       |
// | notes       | varchar(500) | YES  |     | NULL    |       |
// | major       | varchar(20)  | YES  |     | NULL    |       |
// | term        | varchar(10)  | YES  |     | NULL    |       |
// +-------------+--------------+------+-----+---------+-------+

class Courses {
    private $courseId;
    private $subjects;
    private $instructor;
    private $courseStart;
    private $courseEnd;
    private $weekDate;
    private $place;
    private $notes;
    private $major;
    private $term;

    // Getters
    function getCourseID() : int {
        return $this->courseId;
    }
    function getSubjects() : string {
        return $this->subjects;
    }
    function getInstructor() : string {
        return $this->instructor;
    }
    function getCourseStart() {
        return $this->courseStart;
    }
    function getCourseEnd(){
        return $this->courseEnd;
    }
    function getWeekDate() : string {
        return $this->weekDate;
    }
    function getPlace() : string {
        return $this->place;
    }
    function getNotes() : string {
        return $this->notes;
    }
    function getMajor() : string {
        return $this->major;
    }
    function getTerm() : string {
        return $this->term;
    }
    
}



?>