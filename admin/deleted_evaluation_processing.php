<?php
require '../db/dbconn.php';

// Retrieve the request's parameters
$acad_id = isset($_POST['acad_id']) ? $_POST['acad_id'] : null;
$draw = $_POST['draw'];
$start = $_POST['start'];
$length = $_POST['length'];
$searchValue = $_POST['search']['value']; // Global search value

// Build the SQL query
$sqlBase = " FROM eval_tbl as et
            INNER JOIN student_tbl AS st ON et.student_id = st.student_id
            INNER JOIN course_tbl AS ct ON et.course_id = ct.course_id
            INNER JOIN faculty_tbl AS ft ON et.faculty_id = ft.faculty_id
            INNER JOIN class_tbl AS clt ON et.class_id = clt.class_id
            WHERE et.acad_id = '$acad_id' AND et.deleted = 1 ";

if (!empty($searchValue)) {
    $sqlBase .= " AND (st.first_name LIKE '%$searchValue%' OR st.last_name LIKE '%$searchValue%' OR ct.course_code LIKE '%$searchValue%' OR ct.course_name LIKE '%$searchValue%')";
}

// Count the total number of records in the database
$totalRecordsQuery = mysqli_query($conn, "SELECT COUNT(et.eval_id) as total" . $sqlBase);
$totalRecords = mysqli_fetch_assoc($totalRecordsQuery)['total'];

// Count the number of records after filtering
$totalFiltered = $totalRecords; // This would change if you implement additional filtering

// Construct the final SQL based on DataTables parameters
$sql = "SELECT et.eval_id, st.school_id, CONCAT(st.first_name, ' ', st.last_name) as student_name, CONCAT(ct.course_code, ' ', ct.course_name) as course, CONCAT(ft.first_name, ' ', ft.last_name) as faculty_name, CONCAT(clt.program_code, ' ', clt.level, '-',clt.section) AS class, et.date_taken" . $sqlBase . " LIMIT $start, $length";
$query = mysqli_query($conn, $sql);

// Fetch the data
$data = [];
$num = $start + 1; // Start with 1 for the first row
while ($row = mysqli_fetch_assoc($query)) {
    $datetime = new DateTime($row['date_taken']);
    $dateOnly = $datetime->format("d-M-Y");

    $nestedData = [];
    $nestedData[] = $num; // Incrementing number
    $nestedData[] = $row['student_name'];
    $nestedData[] = $row['course'];
    $nestedData[] = $row['faculty_name'];
    $nestedData[] = $row['class'];
    $nestedData[] = $dateOnly;
    $nestedData[] = "<button class='btn btn-info btn-sm' onclick='confirmRestore(\"" . $row['eval_id'] . "\", \"" . $row['student_name'] . "\", \"" . $row['course'] . "\", \"" . $row['class'] . "\")'><i class='fa fa-arrow-rotate-left m-1'></i>Restore</button>";

    $data[] = $nestedData;
    $num++; // Increment for the next row
}

// Prepare the JSON data
$json_data = array(
    "draw" => intval($draw),
    "recordsTotal" => intval($totalRecords),
    "recordsFiltered" => intval($totalFiltered),
    "data" => $data
);

echo json_encode($json_data);
?>
