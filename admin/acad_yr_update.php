<?php
	session_start();
	require '../db/dbconn.php';

	if(isset($_POST['edit'])){
		$acad_id = $_POST['acad_id'];
		$year_start = $_POST['year_start'];
		$year_end = $_POST['year_end'];
		$semester = $_POST['semester'];
		$status = $_POST['status'];
		// $description = $_POST['description'];


		$sql = "UPDATE acad_yr_tbl SET year_start = '$year_start', year_end ='$year_end', semester = '$semester',  status = '$status' WHERE acad_id = '$acad_id'";
		$result = mysqli_query($conn, $sql);

		if($result){
			$_SESSION['success'] = 'Academic Year updated successfully!';
		} else{
			$_SESSION['error'] = 'Failed to update academic year!';
		}

	}
	else{
		$_SESSION['error'] = 'Select academic year to edit first!';
	}

	header('location: acad_yr.php');

?>