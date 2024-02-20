<?php
// Database connection parameters
require '../db/dbconn.php';

if (isset($_POST['selectedDepartment']) && isset($_POST['selectedAcadYear']) && is_numeric($_POST['selectedAcadYear'])) {
    $selectedDepartment = $_POST['selectedDepartment'];
    $selectedAcadYear = $_POST['selectedAcadYear'];

    $selectedAcadYear = intval($selectedAcadYear);

    // SQL query to retrieve the total number of students who submitted evaluations
    $sql = "
        SELECT
            ct.class_id,
            ct.program_code,
            ct.level,
            ct.section,
            CONCAT(ct.program_code, ' ', ct.level, '-', ct.section) AS class_name,
            COUNT(DISTINCT et.student_id) AS totalStudents
        FROM
            eval_tbl AS et
        INNER JOIN
            class_tbl AS ct ON et.class_id = ct.class_id
        WHERE
            et.department = '$selectedDepartment'
            AND et.acad_id = $selectedAcadYear
            AND et.deleted != 1
        GROUP BY
            ct.class_id
    ";

    // Execute the SQL query
    $result = $conn->query($sql);

    if ($result) {
        $classData = [];

        while ($row = $result->fetch_assoc()) {
            $classId = intval($row['class_id']);
            $className = $row['class_name'];
            $totalStudents = intval($row['totalStudents']);

            $classData[] = [
                'classId' => $classId,
                'className' => $className,
                'totalStudents' => $totalStudents,
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
