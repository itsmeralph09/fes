<?php
	session_start();
	require '../db/dbconn.php';

	if(isset($_GET['program_id'])){
		$sql = "DELETE FROM program_tbl WHERE program_id = '".$_GET['program_id']."'";

		if(mysqli_query($conn, $sql)){
			$_SESSION['success'] = 'Program deleted successfully';
		}

		
		else{
			$_SESSION['error'] = 'Something went wrong in deleting program';
		}
	}
	else{
		$_SESSION['error'] = 'Select program to delete first';
	}
	header('Location: program.php');

?>