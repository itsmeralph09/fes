<?php
require '../db/dbconn.php';

class SelectOption {
    private $db;

    public function __construct() {
        // Use the database connection from dbconn.php
        global $conn;
        $this->db = $conn;

        if (!$this->db) {
            die('Failed to connect to MySQL: ' . mysqli_connect_error());
        }
    }

    public function getCriteriaOptions() {
        $query = "SELECT criteria_id, criteria FROM criteria_tbl";
        $result = mysqli_query($this->db, $query);

        $options = '';
        while ($row = mysqli_fetch_assoc($result)) {
            $criteria_id = $row['criteria_id'];
            $criteria = $row['criteria'];
            $options .= "<option value='$criteria_id'>$criteria</option>";
        }

        mysqli_free_result($result);

        return $options;
    }
}
?>
