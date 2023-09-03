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

        if ($password == $confirm_password) {
            $hashed_pass = password_hash($password, PASSWORD_BCRYPT);
            
            $query = "INSERT INTO admin_tbl (school_id, first_name, middle_name, last_name, ext_name, email) VALUES ('$school_id', '$first_name', '$middle_name', '$last_name', '$ext_name', '$email')";
            $result = mysqli_query($conn, $query);

            $query2 = "INSERT INTO user_tbl(school_id, password, role, status) VALUES ('$school_id', '$hashed_pass', 'faculty', 'active')";
            $result2 = mysqli_query($conn, $query2);

            if (!$result && !$result2) {
                // $error = "Error adding student!";
                $_SESSION['error'] = "Error adding admin!";
                header('Location: admin.php');
                exit;  
            } else{
                // $success="Student added successfully!";
                $_SESSION['success'] = "Admin added successfully!";
                header('Location: admin.php');
                exit;
            }
        }else{
            // $error = "Passwords do not match!";
            $_SESSION['error'] = "Passwords do not match!";          
        }

}
header('location: admin.php');


?>