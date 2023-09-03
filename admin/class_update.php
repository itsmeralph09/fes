<?php
	session_start();
	require '../db/dbconn.php';

	if(isset($_POST['edit'])){
		$class_id = $_POST['class_id'];
		$program_code = $_POST['program_code'];
		$program_name = $_POST['program_name'];
		$level = $_POST['level'];
		$section = $_POST['section'];
		$description = $_POST['description'];


		$sql = "UPDATE class_tbl SET program_code = '$program_code', program_name ='$program_name', level = '$level',  section = '$section', description='$description' WHERE class_id = '$class_id'";
		$result = mysqli_query($conn, $sql);

		if($result){
			$_SESSION['success'] = 'Class updated successfully!';
		} else{
			$_SESSION['error'] = 'Failed to update class!';
		}

	}
	else{
		$_SESSION['error'] = 'Select class to edit first!';
	}

	header('location: class.php');

?>