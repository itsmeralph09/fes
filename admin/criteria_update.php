<?php
	session_start();
	require '../db/dbconn.php';

	if(isset($_POST['edit'])){
		$criteria_id = $_POST['criteria_id'];
		$criteria = $_POST['criteria'];
		
		$sql = "UPDATE criteria_tbl SET criteria = '$criteria' WHERE criteria_id = '$criteria_id'";
		$result = mysqli_query($conn, $sql);

		if($result){
			$_SESSION['success'] = 'Criteria updated successfully!';
		} else{
			$_SESSION['error'] = 'Failed to update criteria!';
		}

	}
	else{
		$_SESSION['error'] = 'Select criteria to edit first!';
	}

	header('location: criteria.php');

?>