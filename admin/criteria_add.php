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

    $criteria = $_POST['criteria'];
    $criteriaChecking = strtolower($criteria);


    // Check if section already exists in the database
    $checkSectionQuery= "SELECT * FROM criteria_tbl WHERE criteria = '$criteriaChecking'";
    $checkSectionResult = mysqli_query($conn, $checkSectionQuery);

    if (mysqli_num_rows($checkSectionResult) > 0) {
        $_SESSION['error'] = "Criteria already exists!";
        mysqli_close($conn);
        header('Location: criteria.php');
        exit;
    }

    $query = "INSERT INTO criteria_tbl (criteria) VALUES ('$criteria')";
    $result = mysqli_query($conn, $query);


    if (!$result) {
        $_SESSION['error'] = "Error adding criteria!";
        mysqli_close($conn);
        header('Location: criteria.php');
        exit;  
    } else{
        $_SESSION['success'] = "Criteria added successfully!";
        mysqli_close($conn);
        header('Location: criteria.php');
        exit;
    }

}
header('location: criteria.php');


?>