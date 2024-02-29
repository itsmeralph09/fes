<?php
// fetch_faculty_data.php

// Include your database connection file
require '../db/dbconn.php';

// Retrieve the POST variables
$faculty_id = $_POST['faculty_id'];
$acad_id = $_POST['acad_id'];

// Construct and execute SQL query
$sql = "SELECT ct.course_code, ct.course_name, ft.faculty_id, AVG(eat.score) AS average
        FROM eval_tbl et
        INNER JOIN course_tbl ct ON ct.course_id = et.course_id
        INNER JOIN faculty_tbl ft ON ft.faculty_id = et.faculty_id
        INNER JOIN eval_answer_tbl eat ON eat.eval_id = et.eval_id
        WHERE et.faculty_id = $faculty_id
        AND et.acad_id = $acad_id
        AND et.deleted = 0
        GROUP BY et.course_id";

$result = $conn->query($sql);

// Initialize HTML content for table rows and descriptive rating
$html = '';
$descriptiveRating = '';

while ($row = $result->fetch_assoc()) {
    // Calculate descriptive rating based on average score
    $average = round($row['average'], 2);
    if ($average >= 1 && $average <= 1.99) {
        $descriptiveRating = "Poor";
    } else if ($average >= 2 && $average <= 2.99) {
        $descriptiveRating = "Fair";
    } else if ($average >= 3 && $average <= 3.99) {
        $descriptiveRating = "Satisfactory";
    } else if ($average === 4) {
        $descriptiveRating = "Very Satisfactory";
    }

    // Build HTML for table rows
    $html .= '<tr>';
    $html .= '<td>' . $row['course_code'] . '</td>';
    $html .= '<td>' . $row['course_name'] . '</td>';
    $html .= '<td>' . $average . '</td>'; // Display the average score
    $html .= '<td>' . $descriptiveRating . '</td>'; // Display the descriptive rating
    $html .= '</tr>';
}

// Return the HTML content
echo $html;
?>
