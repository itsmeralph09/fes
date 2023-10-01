<?php
// Database connection parameters
require '../db/dbconn.php';

$courseNames = [];
$criteriaNames = [];
$avgScores = [];
$maxScore = 4;
$facultyId = 1;

if (isset($_POST['selectedCourse']) && is_numeric($_POST['selectedCourse'])) {
    $selectedCourse = $_POST['selectedCourse'];

    // Validate $selectedCourse to prevent SQL injection
    $selectedCourse = intval($selectedCourse);

    // SQL query to retrieve evaluation data for the selected course
    $sql = "
        SELECT
            c.course_name,
            crit.criteria,
            (AVG(eat.score) / $maxScore) * 100 AS avg_score_percentage
        FROM
            eval_tbl AS et
        INNER JOIN
            eval_answer_tbl AS eat ON et.eval_id = eat.eval_id
        INNER JOIN
            question_tbl AS qt ON eat.question_id = qt.question_id
        INNER JOIN
            criteria_tbl AS crit ON qt.criteria_id = crit.criteria_id
        INNER JOIN
            course_tbl AS c ON et.course_id = c.course_id
        WHERE
            et.faculty_id = $facultyId
            AND c.course_id = $selectedCourse
        GROUP BY
            crit.criteria
        ORDER BY
            crit.criteria_order
    ";

    // Execute the SQL query
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $courseNames[] = $row['course_name'];
                $criteriaNames[] = $row['criteria'];
                $avgScores[] = number_format($row['avg_score_percentage'], 2);
            }
        } else {
            // Handle the case where no data is found for the selected course
            // echo 'No data available for the selected course';
        }
    } else {
        // Handle database query error
        echo 'Error executing the SQL query';
    }

    // Prepare data for JSON response
    $data = [
        'criteriaNames' => $criteriaNames,
        'avgScores' => $avgScores,
    ];

    // Return data as JSON
    echo json_encode($data);
} else {
    // Handle invalid or missing input
    echo 'Invalid or missing selected course';
}

// Close the database connection
$conn->close();
?>
