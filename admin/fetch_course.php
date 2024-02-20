<?php
require '../db/dbconn.php';

if (isset($_POST['selectedFaculty'])) {
    $selectedFaculty = $_POST['selectedFaculty'];
    $selectedAcadYear = $_POST['selectedAcadYear'];

    // Query the database to fetch courses based on the selected faculty
    $sql = "SELECT DISTINCT
            e.faculty_id, c.course_id, c.course_code, c.course_name
            FROM eval_tbl e
            INNER JOIN course_tbl c ON e.course_id = c.course_id
            WHERE e.faculty_id = ?
            AND e.deleted != 1
            AND e.acad_id = ? ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $selectedFaculty, $selectedAcadYear);
    $stmt->execute();
    $result = $stmt->get_result();

    $courses = array();
    while ($row = $result->fetch_assoc()) {
        $courses[$row['course_id']] = $row['course_code'] . ' - ' . $row['course_name'];
    }

    echo json_encode($courses);
} else {
    // Handle errors or return an empty array
    echo json_encode(array());
}
?>
