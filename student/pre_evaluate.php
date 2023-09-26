<?php
session_start();

    if (isset($_POST["submit"])) {
        $course_id = $_POST["course_id"];
        $faculty_id = $_POST["faculty_id"];


        require '../db/dbconn.php';

        // SQL query to fetch course records
        $sql = "SELECT * FROM faculty_tbl WHERE faculty_id = '$faculty_id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        // Store course_id and faculty_id in session variables
        $_SESSION['department'] = $row['department'];
        $_SESSION['course_id_to_evaluate'] = $course_id;
        $_SESSION['faculty_id_to_evaluate'] = $faculty_id;

        // Generate a unique evaluation ID based on the current timestamp
        $eval_id = "eval_id_" . $_SESSION['student_id'] . "_" . time(); // "eval_id_" followed by the current Unix timestamp

        // Redirect to evaluate.php with the eval_id as a query parameter
        header("Location: eval.php?eval_id=" . $eval_id);
        exit;
    } else {
        // If course_id or faculty_id is not set, redirect to the previous page
        header("Location: evaluate.php");
        exit;
    }

?>