<?php
if (isset($_POST['academic_year']) && isset($_POST['questions'])) {
    // Step 1: Get the selected academic year and questions from the AJAX request
    $academicYear = $_POST['academic_year'];
    $questions = json_decode($_POST['questions'], true); // Decode the JSON data

    require '../db/dbconn.php';

    // Step 3: Insert questions with their associated criteria_id into the database
    $sql = "INSERT INTO question_tbl (question, acad_id, criteria_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    foreach ($questions as $questionData) {
        $question = $questionData['question'];
        $criteriaId = $questionData['criteria_id'];

        $stmt->bind_param("sii", $question, $academicYear, $criteriaId);
        $stmt->execute();
    }

    // Step 4: Close the database connection
    $stmt->close();
    $conn->close();

    echo "Questions inserted successfully.";
} else {
    echo "Invalid request.";
}
?>
