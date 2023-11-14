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

$department_code = "";
$department_name = "";

if (isset($_POST['submit'])) {
    require '../db/dbconn.php';

    $department_code = strtoupper($_POST['department_code']);
    $department_name = ucwords($_POST['department_name']);


    // Check if section already exists in the database
    $checkSectionQuery= "SELECT * FROM (SELECT *, CONCAT(department_code, ' - ', department_name) AS department FROM department_tbl) AS subquery WHERE department_code = '$department_code'";
    $checkSectionResult = mysqli_query($conn, $checkSectionQuery);

    if (mysqli_num_rows($checkSectionResult) > 0) {
        $_SESSION['error'] = "Department already exists!";
        mysqli_close($conn);
        header('Location: program.php');
        exit;
    }

    $query = "INSERT INTO department_tbl (department_code, department_name) VALUES ('$department_code', '$department_name')";
    $result = mysqli_query($conn, $query);


    if (!$result) {
        $_SESSION['error'] = "Error adding department!";
        mysqli_close($conn);
        header('Location: department.php');
        exit;  
    } else{
        $_SESSION['success'] = "Department added successfully!";
        mysqli_close($conn);
        header('Location: department.php');
        exit;
    }

}
header('location: department.php');


?>