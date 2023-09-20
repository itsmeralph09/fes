<?php
	session_start();
	require '../db/dbconn.php';

	if(isset($_GET['criteria_id'])){
		$sql = "DELETE FROM criteria_tbl WHERE criteria_id = '".$_GET['criteria_id']."'";

		if(mysqli_query($conn, $sql)){
			$_SESSION['success'] = 'Criteria deleted successfully';
		}

		
		else{
			$_SESSION['error'] = 'Something went wrong in deleting criteria';
		}
	}
	else{
		$_SESSION['error'] = 'Select criteria to delete first';
	}

	header('location: criteria.php');
?>