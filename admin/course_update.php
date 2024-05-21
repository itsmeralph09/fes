<?php
	session_start();
	require '../db/dbconn.php';

	if(isset($_POST['edit'])){
		$course_id = mysqli_real_escape_string($conn, $_POST['course_id']);
		$course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
    	$course_name = mysqli_real_escape_string($conn, $_POST['course_name']);
    	$acad_id = mysqli_real_escape_string($conn, $_POST['acad_id']);

		$sql = "UPDATE course_tbl SET course_code = '$course_code', course_name ='$course_name' WHERE course_id = '$course_id'";
		$result = mysqli_query($conn, $sql);

		if($result){
			$_SESSION['success'] = 'Course updated successfully!';
		} else{
			$_SESSION['error'] = 'Failed to update course!';
		}

	}
	else{
		$_SESSION['error'] = 'Select course to edit first!';
	}

	header('location: course.php?acad_id=' . urlencode($acad_id));

?>