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

    public function getDepartmentOptions() {
        $query = "SELECT * FROM department_tbl";
        $result = mysqli_query($this->db, $query);

        $options = '';
        while ($row = mysqli_fetch_assoc($result)) {
            $deptID = $row['department_id'];
            $deptName = strtoupper($row['department_code']) ." - ".ucwords($row['department_name']);
            $options .= "<option value='$deptID'>$deptName</option>";
        }

        mysqli_free_result($result);

        return $options;
    }
}
?>
