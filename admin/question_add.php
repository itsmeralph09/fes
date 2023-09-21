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

$criteria_id = "";
$question = "";
$acad_id = "";

if (isset($_POST['submit'])) {
    require '../db/dbconn.php';

    $criteria_id = $_POST['criteria_id'];
    $question = $_POST['question'];
    $acad_id = $_POST['acad_id'];

    $query = "INSERT INTO question_tbl (question, acad_id, criteria_id) VALUES ('$question','$acad_id','$criteria_id')";
    $result = mysqli_query($conn, $query);


    if (!$result) {
        $_SESSION['error'] = "Error adding question!";
        mysqli_close($conn);
        header('Location: question.php?acad_id=' . urlencode($acad_id));
        exit;  
    } else{
        $_SESSION['success'] = "Question added successfully!";
        mysqli_close($conn);
        header('Location: question.php?acad_id=' . urlencode($acad_id));
        exit;
    }

}
header('Location: question.php?acad_id=' . urlencode($acad_id));


?>