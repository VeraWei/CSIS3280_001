<?php

class SchedulePage
{
    public static $title = "Students Courses Management System";
    public static $courses = [];

    static function header()
    { ?>

        <!doctype html>
        <html lang="en">

        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
            <link rel="stylesheet" href="../css/stylesheet.css">
            <title><?php echo self::$title; ?></title>
            <!-- <meta http-equiv="refresh" content="3"> -->

        </head>

        <body>
            <div class="container">
                <h1><?php echo self::$title; ?></h1>
                <section>


                <?php
            }

            static function footer()
            { ?>

            </div>
            </section>
            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </body>

        </html>
    <?php }

    static function userInfo(User $u) {
    ?>
        <div class="searchForm">
            User Info
            <div class="form-group row">
                <div class="col-md-6">
                    studentId: <?php echo $u->getStudentId(); ?>
                </div>
                <div class="col-md-6">
                    Full Name: <?php echo $u->getFullName(); ?>
                </div>
                <div class="col-md-6">
                    Email: <?php echo $u->getEmail(); ?>
                </div>
                <div class="col-md-6">
                    Major: <?php echo $u->getMajor(); ?>
                </div>
            </div>        

            <div class="form-group row">
                <div class="col-md-6">
                <a class="btn btn-primary" href="userLogout.php" role="button">Logout</a>
                </div>
            </div>

            </div>
        </div>
    <?php
    }

    static function showCourses() {
        ?>
            <div class="row">
                <?php
                
                foreach(self::$courses as $course) {

                    echo "<div  class='col-sm-6'>";
                    echo "<div class='card'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>". $course->getMajor(). " " . $course->getCourseID()."</h5>";
                    echo " <h6 class='card-subtitle mb-2 text-muted'>". $course->getSubjects() ."</h6>";
                    echo "<p class='card-text'> Schedule: " . $course->getCourseStart() . "-" . $course->getCourseEnd() ." ".$course->getWeekDate() ."</p>";
                    echo "<p class='card-text'> Place: " . $course->getPlace() . "</p>";
                    echo "<a class='btn btn-primary' href='?crn=" . $course->getCourseID() ."'>Delete</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </div>
        <?php
    }

    static function showPlaceholder() {
        ?>
            <a href="courseDetail.php"> Go to Add Courses!</a>
        <?php
    }
}

?>