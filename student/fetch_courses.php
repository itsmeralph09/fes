<?php
session_start();
// Include the dbconn.php file for database connection
include('../db/dbconn.php');

// Retrieve the query parameter from the AJAX request
$query = $_POST['query'];
$student_id = $_SESSION['student_id'];

// SQL query to fetch course suggestions
$sql = "SELECT c.course_id, c.course_code, c.course_name
        FROM course_tbl AS c
        LEFT JOIN eval_tbl AS e ON c.course_id = e.course_id AND e.student_id = '$student_id'
        WHERE e.course_id IS NULL
              AND (c.course_code LIKE '%$query%' OR c.course_name LIKE '%$query%')
        ORDER BY c.course_code ASC, c.course_name ASC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display course suggestions as links
        echo '<a class="dropdown-item" href="#">' . $row['course_code'] . ' - ' . $row['course_name'] . '</a>
                <input type="hidden" name="course_id2" value="'.$row['course_id'].'">';
    }
} else {
    // Display a message if no suggestions are found
    echo '<p class="dropdown-item">No matching courses found</p>';
}

// Close the database connection
$conn->close();
?>
