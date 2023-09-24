<?php
require '../db/dbconn.php';

// Query the database to get data
$sql = "SELECT COUNT(*) as count FROM student_tbl";
$result = $conn->query($sql);
$studentCount = $result->fetch_assoc()["count"];

$sql = "SELECT COUNT(*) as count FROM faculty_tbl";
$result = $conn->query($sql);
$facultyCount = $result->fetch_assoc()["count"];

$sql = "SELECT COUNT(*) as count FROM admin_tbl";
$result = $conn->query($sql);
$adminCount = $result->fetch_assoc()["count"];

// Close the database connection
$conn->close();

// Prepare the data for JavaScript
$data = array($studentCount, $facultyCount, $adminCount);

// Convert data to JSON for JavaScript
echo json_encode($data);
?>
