<?php
class SelectOption {
    private $db;

    public function __construct() {
        // Connect to the MySQL database
        $this->db = mysqli_connect('localhost', 'root', '', 'fes_db');
        if (!$this->db) {
            die('Failed to connect to MySQL: ' . mysqli_connect_error());
        }
    }

    public function getClassOptions($currentClassId) {
        $query = "SELECT class_id, program_code, level, section FROM class_tbl";
        $result = mysqli_query($this->db, $query);

        $options = '';
        while ($row = mysqli_fetch_assoc($result)) {
            $classId = $row['class_id'];
            $className = $row['program_code']." ".$row['level']."-".$row['section'];

            if ($classId == $currentClassId) {
                $options .= "<option value='$classId' selected>$className</option>";
            } else {
                $options .= "<option value='$classId'>$className</option>";
            }
        }

        // mysqli_free_result($result);

        return $options;
    }
}
?>
