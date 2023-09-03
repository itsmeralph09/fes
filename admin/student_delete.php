<?php
	session_start();
	require '../db/dbconn.php';

	if(isset($_GET['student_id']) && isset($_GET['school_id'])){
		$sql = "DELETE FROM student_tbl WHERE student_id = '".$_GET['student_id']."'";
		$sql2 = "DELETE FROM user_tbl WHERE school_id = '".$_GET['school_id']."'";

		if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)){
			$_SESSION['success'] = 'Student deleted successfully!';
		}

		
		else{
			$_SESSION['error'] = 'Something went wrong in deleting student!';
		}
	}
	else{
		$_SESSION['error'] = 'Select student to delete first!';
	}

	header('location: new_manage_student.php');
?>