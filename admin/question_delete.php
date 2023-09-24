<?php
	session_start();
	require '../db/dbconn.php';

	if(isset($_GET['question_id'])){
		$sql = "DELETE FROM question_tbl WHERE question_id = '".$_GET['question_id']."'";

		if(mysqli_query($conn, $sql)){
			$_SESSION['success'] = 'Question deleted successfully';
		}

		
		else{
			$_SESSION['error'] = 'Something went wrong in deleting question';
		}
	}
	else{
		$_SESSION['error'] = 'Select question to delete first';
	}
	$acad_id = $_GET['acad_id'];
	header('Location: question.php?acad_id=' . urlencode($acad_id));

?>