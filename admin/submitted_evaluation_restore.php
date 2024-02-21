<?php
// Check if eval_id is provided via POST method
if(isset($_POST['eval_id'])) {
    // Include database connection
    require '../db/dbconn.php';

    // Sanitize the eval_id to prevent SQL injection
    $eval_id = mysqli_real_escape_string($conn, $_POST['eval_id']);

    // SQL query to update the record
    $sql = "UPDATE eval_tbl SET deleted = 0 WHERE eval_id = '$eval_id'";

    // Execute the query
    if(mysqli_query($conn, $sql)) {
        // Return success response
        http_response_code(200);
        echo "Evaluation restored successfully.";
    } else {
        // Return error response
        http_response_code(500);
        echo "Error: " . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
} else {
    // If eval_id is not provided, return error response
    http_response_code(400);
    echo "Error: eval_id is missing.";
}
?>
