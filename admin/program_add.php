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
$department_id = "";

if (isset($_POST['submit'])) {
    require '../db/dbconn.php';

    $program_code = strtoupper($_POST['program_code']);
    $program_name = ucwords($_POST['program_name']);
    $department_id = $_POST['department_id'];
    $program = $program_code . " - " . $program_name;


    // Check if section already exists in the database
    $checkSectionQuery= "SELECT * FROM (SELECT *, CONCAT(program_code, ' - ', program_name) AS program FROM program_tbl) AS subquery WHERE program_name = '$program_name'";
    $checkSectionResult = mysqli_query($conn, $checkSectionQuery);

    if (mysqli_num_rows($checkSectionResult) > 0) {
        $_SESSION['error'] = "Program already exists!";
        mysqli_close($conn);
        header('Location: program.php');
        exit;
    }

    $query = "INSERT INTO program_tbl (program_code, program_name, department_id) VALUES ('$program_code', '$program_name', '$department_id')";
    $result = mysqli_query($conn, $query);


    if (!$result) {
        $_SESSION['error'] = "Error adding program!";
        mysqli_close($conn);
        header('Location: program.php');
        exit;  
    } else{
        $_SESSION['success'] = "Program added successfully!";
        mysqli_close($conn);
        header('Location: program.php');
        exit;
    }

}
header('location: program.php');


?>