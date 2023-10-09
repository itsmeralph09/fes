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
$program_id = "";
$level = "";
$section = "";
$description = "";

if (isset($_POST['submit'])) {
    require '../db/dbconn.php';

    // $program_code = $_POST['program_code'];
    // $program_name = $_POST['program_name'];
    $program_id = $_POST['program_id'];
    $level = $_POST['level'];
    $section = $_POST['section'];

    $fetchProgramQuery = "SELECT * FROM program_tbl WHERE program_id = '$program_id'";
    $fetchProgramResult = mysqli_query($conn, $fetchProgramQuery);

    if (mysqli_num_rows($fetchProgramResult) == 1) {
        $fetchProgramRow = mysqli_fetch_assoc($fetchProgramResult);
        $program_code = strtoupper($fetchProgramRow['program_code']);
        $program_name = ucwords($fetchProgramRow['program_name']);
    }


    $class_name = $program_code." ".$level."-".$section;


    // Check if section already exists in the database
    $checkSectionQuery= "SELECT * FROM (SELECT *, CONCAT(program_code, ' ', level, '-', section) AS class_name FROM class_tbl) AS subquery WHERE class_name = '$class_name'";
    $checkSectionResult = mysqli_query($conn, $checkSectionQuery);

    if (mysqli_num_rows($checkSectionResult) > 0) {
        $_SESSION['error'] = "Class already exists!";
        mysqli_close($conn);
        header('Location: class.php');
        exit;
    }

    $query = "INSERT INTO class_tbl (program_id, program_code, program_name, level, section) VALUES ('$program_id', '$program_code', '$program_name', '$level', '$section')";
    $result = mysqli_query($conn, $query);


    if (!$result) {
        $_SESSION['error'] = "Error adding class!";
        mysqli_close($conn);
        header('Location: class.php');
        exit;  
    } else{
        $_SESSION['success'] = "Class added successfully!";
        mysqli_close($conn);
        header('Location: class.php');
        exit;
    }

}
header('location: class.php');


?>