<?php
// Include your database connection here
require './db/dbconn.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the selected academic year and department from the form
    $selectedAcadYear = $_POST['acad_year'];
    $selectedDepartment = $_POST['department'];

    // Query to retrieve evaluation ratings per criteria for the selected department and academic year
    $sql = "SELECT c.criteria, SUM(a.score) AS total_score
            FROM eval_tbl e
            INNER JOIN eval_answer_tbl a ON e.eval_id = a.eval_id
            INNER JOIN question_tbl q ON a.question_id = q.question_id
            INNER JOIN criteria_tbl c ON q.criteria_id = c.criteria_id
            INNER JOIN acad_yr_tbl ay ON e.acad_id = ay.acad_id
            WHERE ay.acad_id = ? AND e.department = ?
            GROUP BY c.criteria
            ORDER BY c.criteria_order";

    // Prepare and execute the query with parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $selectedAcadYear, $selectedDepartment);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there are results
    if ($result->num_rows > 0) {
        echo "<h2>Evaluation Ratings for Department: $selectedDepartment</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Criteria</th><th>Total Score</th></tr>";

        // Loop through the results and display the report
        while ($row = $result->fetch_assoc()) {
            $criteria = $row['criteria'];
            $totalScore = $row['total_score'];

            echo "<tr><td>$criteria</td><td>$totalScore</td></tr>";
        }

        echo "</table>";
    } else {
        echo "No results found for the selected academic year and department.";
    }

    // Close the statement and result set
    $stmt->close();
    $result->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Evaluation Ratings by Criteria and Department</title>
    <!-- Include your CSS and JavaScript libraries here -->
</head>
<body>
    <h2>Evaluation Ratings by Criteria and Department</h2>
    <form method="POST">
        <label for="acad_year">Select Academic Year:</label>
        <select name="acad_year" id="acad_year">
            <option value="3">3</option>
        </select>

        <label for="department">Select Department:</label>
        <select name="department" id="department">
            <!-- <?php echo $departmentOptions; // Populate this with department options ?> -->
            <option value="ics">ICS</option>
            <option value="ied">IED</option>
        </select>
        
        <button type="submit">Generate Report</button>
    </form>
</body>
</html>
