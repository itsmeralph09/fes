<?php
	session_start();
	require '../db/dbconn.php';

	if(isset($_GET['class_id'])){
		$sql = "DELETE FROM class_tbl WHERE class_id = '".$_GET['class_id']."'";

		if(mysqli_query($conn, $sql)){
			$_SESSION['success'] = 'Class deleted successfully';
		}

		
		else{
			$_SESSION['error'] = 'Something went wrong in deleting class';
		}
	}
	else{
		$_SESSION['error'] = 'Select class to delete first';
	}

	header('location: class.php');
?>