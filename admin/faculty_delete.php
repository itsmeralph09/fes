<?php
	session_start();
	require '../db/dbconn.php';

	if(isset($_GET['faculty_id']) && isset($_GET['school_id'])){
		$sql = "DELETE FROM faculty_tbl WHERE faculty_id = '".$_GET['faculty_id']."'";
		$sql2 = "DELETE FROM user_tbl WHERE school_id = '".$_GET['school_id']."'";

		if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)){
			$_SESSION['success'] = 'Faculty deleted successfully!';
		}

		
		else{
			$_SESSION['error'] = 'Something went wrong in deleting faculty!';
		}
	}
	else{
		$_SESSION['error'] = 'Select faculty to delete first!';
	}

	header('location: faculty.php');
?>