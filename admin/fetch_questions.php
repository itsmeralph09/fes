<?php
// Fetch questions for the selected academic year
if (isset($_POST['academic_year'])) {
    // Step 1: Get the selected academic year from the AJAX request
    $selectedYear = $_POST['academic_year'];

    require '../db/dbconn.php';

    // Step 3: Retrieve questions for the selected academic year
    $sql = "SELECT * FROM question_tbl WHERE acad_id = ? ORDER BY criteria_id ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $selectedYear);
    $stmt->execute();
    $result = $stmt->get_result();

    if (mysqli_num_rows($result) >= 1) {
        $questionList = "<ul>";
        while ($row = $result->fetch_assoc()) {
            $criteriaToFetch = $row['criteria_id'];
            $fetchCriteria = "SELECT * FROM criteria_tbl WHERE criteria_id='$criteriaToFetch'";
            $fetchCriteriaQuery = mysqli_query($conn, $fetchCriteria);
            $fetchRow = mysqli_fetch_assoc($fetchCriteriaQuery);
            $criteria = $fetchRow['criteria'];
        $questionList .= "<li>" . $row['question'] . " - " . $criteria. 
                            "<input type='hidden' class='criteria-id' value='$criteriaToFetch'>" . "</li>";
        }
        $questionList .= "</ul>";
        // Step 6: Return the list of questions as an AJAX response
        echo $questionList;
    } else{
        echo "No questions for this academic year";
    }



    // Step 5: Close the database connection
    $stmt->close();
    $conn->close();


} else {
    // If academic_year is not set in the AJAX request, return an error message
    echo "Invalid request.";
}
?>
