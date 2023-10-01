<?php
// Database connection parameters
require '../db/dbconn.php';

if (isset($_POST['selectedCourse']) && is_numeric($_POST['selectedCourse']) && isset($_POST['facultyId']) && is_numeric($_POST['facultyId'])) {
    $selectedCourse = $_POST['selectedCourse'];
    $facultyId = $_POST['facultyId'];

    // Validate input to prevent SQL injection
    $selectedCourse = intval($selectedCourse);
    $facultyId = intval($facultyId);

    // SQL query to retrieve the total number of students who submitted evaluations
    $sql = "
        SELECT
            ct.class_id,
            ct.program_code,
            ct.level,
            ct.section,
            CONCAT(ct.program_code, ' ', ct.level, '-', ct.section) AS class_name,
            COUNT(et.student_id) AS totalStudents
        FROM
            eval_tbl AS et
        INNER JOIN
            class_tbl AS ct ON et.class_id = ct.class_id
        WHERE
            et.course_id = $selectedCourse
            AND et.faculty_id = $facultyId
        GROUP BY
            ct.class_id
    ";


    // Execute the SQL query
    $result = $conn->query($sql);

    if ($result) {
        $classData = [];

    while ($row = $result->fetch_assoc()) {
        $className = $row['program_code'] . ' ' . $row['level'] . '-' . $row['section'];
        $classData[] = [
            'classId' => intval($row['class_id']),
            'className' => $className,
            'totalStudents' => intval($row['totalStudents']),
        ];
    }


        // Prepare data for JSON response
        $data = [
            'classData' => $classData,
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
