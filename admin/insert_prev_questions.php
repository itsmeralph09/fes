<?php
session_start(); // Make sure to start the session

if (isset($_POST['academic_year']) && isset($_POST['questions'])) {
    // Step 1: Get the selected academic year and questions from the AJAX request
    $academicYear = $_POST['academic_year'];
    $questions = json_decode($_POST['questions'], true); // Decode the JSON data
    $acad_id = $_POST['acad_id'];

    require '../db/dbconn.php';

    // Step 2: Get the acad_id based on the selected academic year
    $getAcadIdSql = "SELECT acad_id FROM question_tbl WHERE acad_id = ?"; // Modify this query based on your database schema
    $stmtGetAcadId = $conn->prepare($getAcadIdSql);
    $stmtGetAcadId->bind_param("s", $academicYear);
    $stmtGetAcadId->execute();
    $stmtGetAcadId->bind_result($acadId);
    $stmtGetAcadId->fetch();
    $stmtGetAcadId->close();

    if ($acadId) {
        // Step 3: Insert questions with their associated criteria_id into the database
        $sql = "INSERT INTO question_tbl (question, acad_id, criteria_id) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        $success = true; // Initialize success flag

        foreach ($questions as $questionData) {
            $question = $questionData['question'];
            $criteriaId = $questionData['criteria_id'];

            $stmt->bind_param("sii", $question, $acad_id, $criteriaId);
            if (!$stmt->execute()) {
                $success = false; // Set success flag to false if any insertion fails
                break; // Exit the loop if an insertion fails
            }
        }

        // Step 4: Close the database connection
        $stmt->close();
        $conn->close();

if ($success) {
    // After successful insertion
    $response = array('success' => true);
    echo json_encode($response);
    exit;
} else {
    // If insertion fails
    $response = array('success' => false, 'error' => 'Failed to insert questions. Please try again.');
    echo json_encode($response);
    exit;
}

    } else {
        // Set an error message in the session for an invalid academic year
        $_SESSION['error'] = "Invalid academic year!";
    }
} else {
    // Set an error message in the session for invalid requests
    $_SESSION['error'] = "Invalid request!";
}

// Redirect to questions.php with appropriate messages
header("Location: question.php?acad_id=$acad_id");
exit;
?>
