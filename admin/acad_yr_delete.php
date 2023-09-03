<?php
	session_start();
	require '../db/dbconn.php';

	if(isset($_GET['acad_id'])){
		$sql = "DELETE FROM acad_yr_tbl WHERE acad_id = '".$_GET['acad_id']."'";

		if(mysqli_query($conn, $sql)){
			$_SESSION['success'] = 'Academic year deleted successfully';
		}

		
		else{
			$_SESSION['error'] = 'Something went wrong in deleting acdemic year';
		}
	}
	else{
		$_SESSION['error'] = 'Select academic year to delete first';
	}

	header('location: acad_yr.php');
?>