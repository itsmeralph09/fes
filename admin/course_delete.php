<?php
	session_start();
	require '../db/dbconn.php';

	if(isset($_GET['course_id'])){
		$sql = "DELETE FROM course_tbl WHERE course_id = '".$_GET['course_id']."'";

		if(mysqli_query($conn, $sql)){
			$_SESSION['success'] = 'Course deleted successfully';
		}

		
		else{
			$_SESSION['error'] = 'Something went wrong in deleting course';
		}
	}
	else{
		$_SESSION['error'] = 'Select course to delete first';
	}

	header('location: course.php');
?>