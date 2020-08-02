<?php

class CoursePage
{
    public static $title = "Goup 7 Project Work - Students Courses Management System";
    public static $scheduleCourses = [];

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
        <div class="card" id="userInfo">
            <h5 class="card-header">Student Current Status</h5>
            <div class="card-body">
                <p class="card-text">
                    <b>StudentID:</b> <?php echo $u->getStudentId(); ?> 
                    <b>Student Name:</b> <?php echo $u->getFullName(); ?>
                    <b>Email:</b> <?php echo $u->getEmail(); ?>
                    <b>Major:</b> <?php echo $u->getMajor(); ?>
                    <a href="userLogout.php" class="btn btn-primary" style="margin-left:15px">Logout</a>
                </p>
            </div>
        </div>
    <?php
    }

    static function showSearchBar()
    { ?>

        <div class="searchForm">
            <form class="form-signin" action="" method="POST" style="max-width: 330px;">
                <h5 class="form-signin-heading">Search Courses by ID</h5>
                <div class="form-group">
                    <input type="number" id="inputCourse" class="form-control" placeholder="Enter Courses Section ID" name="inputCourse" />
                </div>
                <div>
                    <button name="search" class="btn btn-lg btn-primary btn-block" type="submit">
                        Search Course
                    </button>
                </div>
                <div style="margin-top: 40px;">
                    <h5 class="form-signin-heading">Search Courses by Filter</h5>
                    <div class="form-group">
                        <select name="major" class="form-control">
                            <option value="" disabled selected>Choose Your Major</option>
                            <option value="ACCT">Accounting(ACCT)</option>
                            <option value="BUSN">Business(BUSN)</option>
                            <option value="ECON">Ecnomic(ECON)</option>
                            <option value="CSIS">Computing St & Info Systems(CSIS)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="term" class="form-control">
                            <option value="" disabled selected>Choose Your Term</option>
                            <option value="2020winter">2020 Winter</option>
                            <option value="2020summer">2020 Summer</option>
                            <option value="2020fall">2020 Fall</option>
                        </select>
                    </div>
                    <div>
                        <button name="confirm" class="btn btn-lg btn-primary btn-block" type="submit">
                            Confirm
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <?php
    }

    static function showResult($courses)
    { ?>
        <div id="resultShow">
            <div class="card">
                <div class="card-header">
                    After Selecting Courses, Do Not Forget To Submit
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        <table class="table table-borderless">
                            <tbody>
                                <?php
                                foreach ($courses as $course) {
                                    $isChecked = in_array((int)$course->getCourseID(), self::$scheduleCourses);
                                    echo "<td><div class='course-card'>";
                                    if ($isChecked) {
                                        echo "<input disabled checked name='courseList[]' type='checkbox' value='" . $course->getCourseID() . "'/>";
                                    } else {
                                        echo "<input name='courseList[]' type='checkbox' value='" . $course->getCourseID() . "'/>";
                                    }
                                    echo "<div class='course-content'>";
                                    echo "<h5 class='card-title'>Course Title : " . "  " . $course->getCourseID() . " " .  $course->getSubjects() . " " . $course->getWeekDate() . "</h5>";
                                    echo "<p class='card-text'>Instructor:" . "  " . $course->getInstructor() . "</p>";
                                    echo "<p class='card-text'>Schedule:" . "  " . $course->getCourseStart() . " - " . $course->getCourseEnd() . "</p>";
                                    echo "<p class='card-text'>Classroom:" . "  " . $course->getPlace() . "</p>";
                                    echo "<p class='card-text'>Classroom:" . "  " . $course->getNotes() . "</p>";
                                    echo "</div></div></td></tr>";
                                } ?>
                                <tr>
                                    <td>
                                        <button class="btn btn-primary" type="submit" name="courseSubmit">
                                            Submit
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>

        <?php
        }

        static function showCourses(Course $course) {
            ?>
            <div>
                <?php
                    echo "<h5 class='card-title'>Course Title : " . "  " . $course->getCourseID() . " " .  $course->getSubjects() . " " . $course->getWeekDate() . "</h5>";
                ?>
            </div>
            <?php
        }
    }

?>