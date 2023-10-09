<?php
	session_start();
	

	if(isset($_POST['edit'])){
		require '../db/dbconn.php';

		$class_id = $_POST['class_id'];
		// $program_code = $_POST['program_code'];
		// $program_name = $_POST['program_name'];
		$program_id = $_POST['program_ids'];
		$level = $_POST['level'];
		$section = $_POST['section'];
		// $description = $_POST['description'];

	    $fetchProgramQuery = "SELECT * FROM program_tbl WHERE program_id = '$program_id'";
	    $fetchProgramResult = mysqli_query($conn, $fetchProgramQuery);

	    if (mysqli_num_rows($fetchProgramResult) == 1) {
	        $fetchProgramRow = mysqli_fetch_assoc($fetchProgramResult);
	        $program_code = strtoupper($fetchProgramRow['program_code']);
	        $program_name = ucwords($fetchProgramRow['program_name']);
	    }

		$sql = "UPDATE class_tbl SET program_id = '$program_id', program_code = '$program_code', program_name ='$program_name', level = '$level',  section = '$section' WHERE class_id = '$class_id'";
		$result = mysqli_query($conn, $sql);

		if($result){
			$_SESSION['success'] = 'Class updated successfully!';
		} else{
			$_SESSION['error'] = 'Failed to update class!'.mysql_error();
		}

	}
	else{
		$_SESSION['error'] = 'Select class to edit first!';
	}

	header('location: class.php');

?>