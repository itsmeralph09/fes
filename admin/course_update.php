<?php
	session_start();
	require '../db/dbconn.php';

	if(isset($_POST['edit'])){
		$course_id = $_POST['course_id'];
		$course_code = $_POST['course_code'];
		$course_name = $_POST['course_name'];

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

	header('location: course.php');

?>