<?php
// Include the dbconn.php file for database connection
include('db/dbconn.php');

class SelectOption {
    private $db;

    public function __construct() {
        // Use the database connection from dbconn.php
        global $conn;
        $this->db = $conn;
    }

    public function getClassOptions() {
        $query = "SELECT class_id, program_code, level, section FROM class_tbl ORDER BY program_code ASC, level ASC, section ASC";
        $result = mysqli_query($this->db, $query);

        $options = '';
        while ($row = mysqli_fetch_assoc($result)) {
            $classId = $row['class_id'];
            $className = $row['program_code']." ".$row['level']."-".$row['section'];
            $options .= "<option value='$classId'>$className</option>";
        }

        mysqli_free_result($result);

        return $options;
    }
}
?>
