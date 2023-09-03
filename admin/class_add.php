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

$program_code = "";
$program_name = "";
$level = "";
$section = "";
$description = "";

if (isset($_POST['submit'])) {
    require '../db/dbconn.php';

    $program_code = $_POST['program_code'];
    $program_name = $_POST['program_name'];
    $level = $_POST['level'];
    $section = $_POST['section'];
    // $description = $_POST['description'];

    $query = "INSERT INTO class_tbl (program_code, program_name, level, section) VALUES ('$program_code', '$program_name', '$level', '$section')";
    $result = mysqli_query($conn, $query);


    if (!$result) {
        $_SESSION['error'] = "Error adding class!";
        header('Location: class.php');
        exit;  
    } else{
        $_SESSION['success'] = "Class added successfully!";
        header('Location: class.php');
        exit;
    }

}
header('location: class.php');


?>