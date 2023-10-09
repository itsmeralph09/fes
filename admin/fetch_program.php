<?php
// Include the dbconn.php file for database connection
include('../db/dbconn.php');

class SelectOption {
    private $db;

    public function __construct() {
        // Use the database connection from dbconn.php
        global $conn;
        $this->db = $conn;
    }

    public function getProgramOptions() {
        $query = "SELECT * FROM program_tbl ORDER BY department_id ASC";
        $result = mysqli_query($this->db, $query);

        $options = '';
        while ($row = mysqli_fetch_assoc($result)) {
            $progID = $row['program_id'];
            $progName = strtoupper($row['program_code']) ." - ".ucwords($row['program_name']);
            $options .= "<option value='$progID'>$progName</option>";
        }

        mysqli_free_result($result);

        return $options;
    }
}
?>
