<?php
// Database connection parameters
require '../db/dbconn.php';

if (isset($_POST['selectedDepartment']) && isset($_POST['selectedAcadYear']) && is_numeric($_POST['selectedAcadYear'])) {
    $selectedDepartment = $_POST['selectedDepartment'];
    $selectedAcadYear = $_POST['selectedAcadYear'];

    $selectedAcadYear = intval($selectedAcadYear);

    // SQL query to retrieve evaluation ratings per criteria along with the number of answers per criterion
    $sql = "SELECT c.criteria, SUM(a.score) AS total_score, COUNT(a.eval_id) AS num_answers
            FROM eval_tbl e
            INNER JOIN eval_answer_tbl a ON e.eval_id = a.eval_id
            INNER JOIN question_tbl q ON a.question_id = q.question_id
            INNER JOIN criteria_tbl c ON q.criteria_id = c.criteria_id
            INNER JOIN acad_yr_tbl ay ON e.acad_id = ay.acad_id
            WHERE ay.acad_id = ? AND e.department = ?
            GROUP BY c.criteria
            ORDER BY c.criteria_order";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    // Bind the parameters
    $stmt->bind_param("is", $selectedAcadYear, $selectedDepartment);

    // Execute the SQL query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result) {
        $criteriaData = [];

        while ($row = $result->fetch_assoc()) {
            $criteria = $row['criteria'];
            $totalScore = intval($row['total_score']);
            $numAnswers = intval($row['num_answers']); // Number of evaluation answers for this criterion

            // Calculate the percentage score
            $maxScore = 4; // Maximum score for each question
            $percentageScore = ($totalScore / ($maxScore * $numAnswers)) * 100;

            $criteriaData[] = [
                'criteria' => $criteria,
                'totalScore' => $totalScore,
                'numAnswers' => $numAnswers, // Add the number of answers to the array
                'percentageScore' => $percentageScore,
            ];
        }

        // Prepare data for JSON response
        $data = [
            'criteriaData' => $criteriaData,
        ];

        // Return data as JSON
        echo json_encode($data);
    } else {
        // Handle database query error
        echo json_encode(['error' => 'Error executing the SQL query']);
    }
} else {
    // Handle invalid or missing input
    echo json_encode(['error' => 'Invalid or missing input']);
}

// Close the database connection
$conn->close();
?>
