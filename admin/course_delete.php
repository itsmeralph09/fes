<?php
	session_start();
	require '../db/dbconn.php';

	if(isset($_GET['course_id'])){
		$course_id = mysqli_real_escape_string($conn, $_GET['course_id']);
    	$acad_id = mysqli_real_escape_string($conn, $_GET['acad_id']);

		// $sql = "DELETE FROM course_tbl WHERE course_id = '".$_GET['course_id']."'";
		$sql = "UPDATE course_tbl SET deleted=1 WHERE course_id='$course_id'";

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

	header('location: course.php?acad_id=' . urlencode($acad_id));
?>