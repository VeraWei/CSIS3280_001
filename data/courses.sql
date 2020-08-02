drop database if exists FP_yanyi;
create database FP_yanyi;
use FP_yanyi;

create table Student (
	studentId INT AUTO_INCREMENT PRIMARY KEY,
	full_name VARCHAR(50),
	email VARCHAR(20),
    major VARCHAR(50),
	password VARCHAR(250)
) Engine=InnoDB AUTO_INCREMENT = 300000000;

create table Courses (
    courseId INT(4) PRIMARY KEY,
    subjects VARCHAR(50),
    instructor VARCHAR(50),
    courseStart TIME,
    courseEnd TIME,
    weekDate VARCHAR(10),
    place VARCHAR(50),
    notes TEXT(500),
    major VARCHAR(20),
    term VARCHAR(10)
) Engine=InnoDB;

INSERT INTO Courses (courseId, subjects, instructor, courseStart, courseEnd, weekDate, place, notes, major, term) VALUES
(1175, 'Introduction to Programming','Zhe Yang', '09:30', '12:20', 'WED', 'N5107', 'CSIS 1175 001 is restricted to students in the following programs: Cmpt Science and Info Systems Dipl, Cmpt Studies and Info Systems Dipl, Emerging', 'CSIS', '2020fall'),
(1280, 'Multimedia Web Development', 'Caesar Jude Clemente','12:30', '15:20', 'THUR', 'N6107', 'This course covers the fundamentals of Web site development and design using HTML, CSS and JavaScript. Students will learn how to create structured websites using HTML, how to use the most up to date CSS styles to create responsive, visually-interesting pages and captivating graphical designs, and how to implement client-side script using basic concepts in JavaScript to access DOM elements and to validate web forms.', 'CSIS', '2020fall'),
(2200, 'Systems Analysis & Design','Richard P. Wong', '09:00', '12:20', 'THUR', 'N4308', 'Student must have already completed 9 credits any 1000-level course from the Faculty of Commerce and Business Administration. If you have any questions, please email your inquiry to CSIS chair Simon Li lis@douglascollege.ca with your student ID and full name in the email. Put down CSIS2200 prereq inquiry on the email subject line otherwise your email may not be read.', 'CSIS', '2020fall'),
(1210, 'Principles of Accounting II','Selina Tang', '12:30', '15:20', 'MON', 'N4370', 'This course is a continuation of ACCT 1110 and will introduce the student to accounting for and amortization/depreciation of capital assets and intangibles; goodwill; accounting for various types of liabilities; accounting for corporations and investments; the statement of cash flows, analysis of financial statements; and an introduction to partnerships. Accounting principles will also be reviewed.', 'ACCT', '2020fall'),
(1103, 'Globalization, World Economy', 'Les Marshall', '09:30', '11:20', 'FRI', 'N4312', 'Globalization and the World Economy provides an overview of the broad economic trends in the development of the world economy since the second world war. The course will address the major debates relating to economic interdependence, economic development and growth, the patterns of international trade and investment, global financial markets, natural resource scarcity, and the role of major multilateral economic institutions such as the World Bank and IMF. The course will also introduce some of the main economic theories which have played a significant role in these debates. The material presented in this course will appeal to anyone looking for a deeper understanding of contemporary world events in the economic, political and social spheres.', 'ECON', '2020fall'),
(1200, 'Fundamentals of Business', 'George Broderick', '16:30', '18:20', 'WED', 'N5105', 'This course provides a broad overview of the Canadian business system -- how it functions, and how it relates to specific areas such as marketing, production and finance. The course provides a specific insight into actual business operations and some of the major areas of concern regarding the role of business in society.Section Notes:	This course will include synchronous on-line activities. Students should plan to be available on-line at scheduled course times.', 'BUSN', '2020fall' );


create table Schedule (
	courseId INT(4) NOT NULL,
	studentId INT NOT NULL,
	PRIMARY KEY(courseId, studentId),
    FOREIGN KEY (courseId) REFERENCES Courses(courseId),
    FOREIGN KEY (studentId) REFERENCES Student(studentId)

)Engine=InnoDB;


INSERT INTO Student (studentid, password, email, full_name, major) VALUES
(300000000, '$2y$10$oziFFuYd.LtRHuYzBSZwsuign27SMgc1oAI5uwG/Tk9mOxIoGyA.q', '123@gmail.com', 'Yanyi Li', 'CSIS'),
(300000001, '$2y$10$oziFFuYd.LtRHuYzBSZwsuign27SMgc1oAI5uwG/Tk9mOxIoGyA.q', 'xyz@gmail.com', 'Steven', 'BUSS'),
(300000002, '$2y$10$oziFFuYd.LtRHuYzBSZwsuign27SMgc1oAI5uwG/Tk9mOxIoGyA.q', 'lll@gmail.com', 'Victor', 'ACCT'),
(300000003, '$2y$10$oziFFuYd.LtRHuYzBSZwsuign27SMgc1oAI5uwG/Tk9mOxIoGyA.q', 'qqq@gmail.com', 'Jack', 'ECON');

INSERT INTO Schedule VALUES (1175, 300000000);
INSERT INTO Schedule VALUES (1280, 300000000);
INSERT INTO Schedule VALUES (2200, 300000001);
INSERT INTO Schedule VALUES (2200, 300000002);
INSERT INTO Schedule VALUES (1210, 300000003);