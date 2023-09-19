<?php
session_start();
if (!isset($_SESSION['school_id'])) {
    header("Location: ../login.php");
    $_SESSION['error'] = "You must login first!";
    exit;
}

if ($_SESSION['role'] != "admin") {
    header("Location: ../login.php");
    $_SESSION['error'] = "You must login first!";
    exit;
} elseif ($_SESSION['role'] == "faculty") {
    header("Location: ../faculty/index.php");
    exit;
} elseif ($_SESSION['role'] == "student"){
    header("Location: ../student/index.php");
    exit;
}

$course_code = "";
$course_name = "";

if (isset($_POST['submit'])) {
    require '../db/dbconn.php';

    $course_code = $_POST['course_code'];
    $course_name = $_POST['course_name'];


    // Check if section already exists in the database
    $checkSectionQuery= "SELECT * FROM course_tbl WHERE course_code = '$course_code'";
    $checkSectionResult = mysqli_query($conn, $checkSectionQuery);

    if (mysqli_num_rows($checkSectionResult) > 0) {
        $_SESSION['error'] = "Course Code already exists!";
        mysqli_close($conn);
        header('Location: course.php');
        exit;
    }

    $query = "INSERT INTO course_tbl (course_code, course_name) VALUES ('$course_code', '$course_name')";
    $result = mysqli_query($conn, $query);


    if (!$result) {
        $_SESSION['error'] = "Error adding course!";
        mysqli_close($conn);
        header('Location: course.php');
        exit;  
    } else{
        $_SESSION['success'] = "Course added successfully!";
        mysqli_close($conn);
        header('Location: course.php');
        exit;
    }

}
header('location: course.php');


?>