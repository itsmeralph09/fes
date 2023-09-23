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

$first_name = "";
$middle_name = "";
$last_name = "";
$ext_name = "";
$school_id = "";
$email = "";
$password = "";
$confirm_password = "";
$department = "";

if (isset($_POST['submit'])) {
    require '../db/dbconn.php';

    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $ext_name = $_POST['ext_name'];
    $school_id = $_POST['school_id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $department = $_POST['department'];

    // Check if email already exists in the database
    $checkEmailQuery = "SELECT * FROM faculty_tbl WHERE email = '$email'";
    $checkEmailResult = mysqli_query($conn, $checkEmailQuery);

    if (mysqli_num_rows($checkEmailResult) > 0) {
        $_SESSION['error'] = "Email already exists!";
        mysqli_close($conn);
        header('Location: faculty.php');
        exit;
    }

    // Check if school ID already exists in the database
    $checkSchoolIDQuery = "SELECT * FROM faculty_tbl WHERE school_id = '$school_id'";
    $checkSchoolIDResult = mysqli_query($conn, $checkSchoolIDQuery);

    if (mysqli_num_rows($checkSchoolIDResult) > 0) {
        $_SESSION['error'] = "School ID already exists!";
        mysqli_close($conn);
        header('Location: faculty.php');
        exit;
    }

        if ($password == $confirm_password) {
            $hashed_pass = password_hash($password, PASSWORD_BCRYPT);
            
            $query = "INSERT INTO faculty_tbl (school_id, first_name, middle_name, last_name, ext_name, email, department) VALUES ('$school_id', '$first_name', '$middle_name', '$last_name', '$ext_name', '$email', '$department')";
            $result = mysqli_query($conn, $query);

            $query2 = "INSERT INTO user_tbl(school_id, password, role, status) VALUES ('$school_id', '$hashed_pass', 'faculty', 'active')";
            $result2 = mysqli_query($conn, $query2);

            if (!$result && !$result2) {
                // $error = "Error adding student!";
                $_SESSION['error'] = "Error adding faculty!";
                header('Location: faculty.php');
                exit;  
            } else{
                // $success="Student added successfully!";
                $_SESSION['success'] = "Faculty added successfully!";
                header('Location: faculty.php');
                exit;
            }
        }else{
            // $error = "Passwords do not match!";
            $_SESSION['error'] = "Passwords do not match!";          
        }

}
header('location: faculty.php');


?>