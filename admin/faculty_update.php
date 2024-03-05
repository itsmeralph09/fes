<?php
session_start();
require '../db/dbconn.php';

if(isset($_POST['edit'])){
    $faculty_id = $_POST['faculty_id'];
    $old_school_id = $_POST['old_school_id']; // Add a hidden input field to pass the old school_id
    $new_school_id = $_POST['school_id'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $ext_name = $_POST['ext_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $department = $_POST['department'];
    $user_id = $_POST['user_id'];

    // Check if school_id has changed and if the new school_id is already taken
    if ($old_school_id != $new_school_id) {
        $query_check_school_id = "SELECT * FROM user_tbl WHERE school_id = '$new_school_id'";
        $result_check_school_id = mysqli_query($conn, $query_check_school_id);
        if (mysqli_num_rows($result_check_school_id) > 0) {
            $_SESSION['error'] = 'School ID already taken!';
            header('location: faculty.php');
            exit();
        }
    }

    if (empty($password)) {
        // Update faculty table
        $sql = "UPDATE faculty_tbl SET first_name = '$first_name', middle_name ='$middle_name', last_name = '$last_name',  ext_name = '$ext_name', email='$email', department='$department', school_id = '$new_school_id' WHERE faculty_id = '$faculty_id'";
        $result = mysqli_query($conn, $sql);
        if($result){
            // Update user table for school_id
            $sql_update_school_id = "UPDATE user_tbl SET school_id='$new_school_id' WHERE user_id ='$user_id'";
            $result_update_school_id = mysqli_query($conn, $sql_update_school_id);
            if ($result_update_school_id) {
                $_SESSION['success'] = 'Faculty updated successfully, but password remains unchanged!';
            } else {
                $_SESSION['error'] = 'Failed to update school ID in user table!';
            }
        } else {
            $_SESSION['error'] = 'Failed to update faculty!';
        }
    } else {
        // Password is not empty, process password update as before
        if ($password==$confirm_password) {
            $hashed_pass = password_hash($password, PASSWORD_BCRYPT);
            $sql2 = "UPDATE user_tbl SET password ='$hashed_pass' WHERE user_id ='$user_id'";
            $result2 = mysqli_query($conn, $sql2);

            $sql = "UPDATE faculty_tbl SET first_name = '$first_name', middle_name ='$middle_name', last_name = '$last_name',  ext_name = '$ext_name', email='$email', department='$department', school_id = '$new_school_id' WHERE faculty_id = '$faculty_id'";
            $result = mysqli_query($conn, $sql);
            if($result || $result2){
                $_SESSION['success'] = 'Faculty updated successfully, and password changed!';
            }
        } else {
            $_SESSION['error'] = "Passwords do not match!";
        }
    }
} else {
    $_SESSION['error'] = 'Select faculty to edit first';
}

header('location: faculty.php');

?>