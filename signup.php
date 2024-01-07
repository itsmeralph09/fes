<?php
session_start();

$first_name = "";
$middle_name = "";
$last_name = "";
$ext_name = "";
$class_id = "";
$school_id = "";
$email = "";
$password = "";
$confirm_password = "";

if (isset($_POST['submit'])) {
    require 'db/dbconn.php';

    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $ext_name = $_POST['ext_name'];
    $class_id = $_POST['class_id'];
    $school_id = $_POST['school_id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if email already exists in the student_tbl
    $checkEmailQuery = "SELECT * FROM student_tbl WHERE email = ?";
    $stmtEmail = mysqli_prepare($conn, $checkEmailQuery);
    mysqli_stmt_bind_param($stmtEmail, "s", $email);
    mysqli_stmt_execute($stmtEmail);
    $checkEmailResult = mysqli_stmt_get_result($stmtEmail);

    if (mysqli_num_rows($checkEmailResult) > 0) {
        $_SESSION['error'] = "Email is already taken!";
        mysqli_close($conn);
        header('Location: signup_page.php');
        exit;
    }

    // Check if school ID already exists in the student_tbl
    $checkFacultyQuery = "SELECT * FROM student_tbl WHERE school_id = ?";
    $stmtFaculty = mysqli_prepare($conn, $checkFacultyQuery);
    mysqli_stmt_bind_param($stmtFaculty, "s", $school_id);
    mysqli_stmt_execute($stmtFaculty);
    $checkFacultyResult = mysqli_stmt_get_result($stmtFaculty);

    // Check if school ID already exists in the user_tbl
    $checkUserQuery = "SELECT * FROM user_tbl WHERE school_id = ?";
    $stmtUser = mysqli_prepare($conn, $checkUserQuery);
    mysqli_stmt_bind_param($stmtUser, "s", $school_id);
    mysqli_stmt_execute($stmtUser);
    $checkUserResult = mysqli_stmt_get_result($stmtUser);

    if (mysqli_num_rows($checkFacultyResult) > 0 || mysqli_num_rows($checkUserResult) > 0) {
        $_SESSION['error'] = "School ID is already taken!";
        mysqli_close($conn);
        header('Location: signup_page.php');
        exit;
    }

    if ($password == $confirm_password) {
        $hashed_pass = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO student_tbl(school_id, first_name, middle_name, last_name, ext_name, class_id, email) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmtInsertStudent = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmtInsertStudent, "sssssis", $school_id, $first_name, $middle_name, $last_name, $ext_name, $class_id, $email);
        $result = mysqli_stmt_execute($stmtInsertStudent);

        $query2 = "INSERT INTO user_tbl(school_id, password, role, status) VALUES (?, ?, 'student', 'active')";
        $stmtInsertUser = mysqli_prepare($conn, $query2);
        mysqli_stmt_bind_param($stmtInsertUser, "ss", $school_id, $hashed_pass);
        $result2 = mysqli_stmt_execute($stmtInsertUser);

        if (!$result || !$result2) {
            $_SESSION['error'] = "Error registering account! Please try again.";
            mysqli_close($conn);
            header('Location: signup_page.php');
            exit;
        } else {
            $_SESSION['success'] = "Account registered successfully, you can now login your account!";
            header('Location: login.php');
            mysqli_close($conn);
            exit;
        }
    } else {
        $_SESSION['error'] = "Passwords do not match!";
        mysqli_close($conn);
        header('Location: signup_page.php');
        exit;
    }
}
header('Location: signup_page.php');
exit;
?>
