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

    $year_start = "";
    $year_end = "";
    $semester = "";
    $status = "";

if (isset($_POST['submit'])) {
    require '../db/dbconn.php';

    $year_start = $_POST['year_start'];
    $year_end = $_POST['year_end'];
    $semester = $_POST['semester'];
    $status = $_POST['status'];

    $query = "INSERT INTO acad_yr_tbl (year_start, year_end, semester, status) VALUES ('$year_start', '$year_end', '$semester', '$status')";
    $result = mysqli_query($conn, $query);


    if (!$result) {
        $_SESSION['error'] = "Error adding academic year!";
        header('Location: class.php');
        exit;  
    } else{
        $_SESSION['success'] = "Academic year added successfully!";
        header('Location: acad_yr.php');
        exit;
    }

}
header('location: acad_yr.php');


?>