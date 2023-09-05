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
    // $semester = "";
    // $status = "";
    $acad_year = "";

if (isset($_POST['submit'])) {
    require '../db/dbconn.php';

    $year_start = $_POST['year_start'];
    $year_end = $_POST['year_end'];
    // $semester = $_POST['semester'];
    // $status = $_POST['status'];
    $acad_year = $year_start."-".$year_end;

    // Check if academic year already exists in the database
    $checkAcadYearQuery = "SELECT * FROM (SELECT *, CONCAT(year_start, '-', year_end) AS acad_year FROM acad_yr_tbl) AS subquery WHERE acad_year = '$acad_year'";
    $checkAcadYearResult = mysqli_query($conn, $checkAcadYearQuery);

   if (mysqli_num_rows($checkAcadYearResult) > 0) {
        $_SESSION['error'] = "Academic year "."$acad_year"." already exists!";
        mysqli_close($conn);
        header('Location: acad_yr.php');
        exit;
    }

    $query = "INSERT INTO acad_yr_tbl (year_start, year_end, semester, status)
    VALUES ('$year_start', '$year_end', '1', 'pending'),
       ('$year_start', '$year_end', '2', 'pending'),
       ('$year_start', '$year_end', '3', 'pending')";

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