<?php
	session_start();
	require '../db/dbconn.php';

	if(isset($_GET['eval_id'])){
		$acad_id = $_GET['acad_id'];
		$sql = "UPDATE eval_tbl SET deleted = 1 WHERE eval_id = '".$_GET['eval_id']."'";

		if(mysqli_query($conn, $sql)){
			$_SESSION['success'] = 'Submitted evaluation deleted successfully';
		}

		else{
			$_SESSION['error'] = 'Something went wrong in deleting submitted evaluation';
		}
	}
	else{
		$_SESSION['error'] = 'Select submitted evaluation to delete first';
	}

	header('Location: submitted_evaluation.php?acad_id=' . urlencode($acad_id));

?>