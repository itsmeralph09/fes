<?php
	session_start();
	require '../db/dbconn.php';

	if(isset($_POST['edit'])){

		$question_id = $_POST['question_id'];
		$question = $_POST['question'];
		$criteria_id = $_POST['criteria_ids'];
		$acad_id = $_POST['acad_id'];

		$sql = "UPDATE question_tbl SET question = '$question', criteria_id ='$criteria_id' WHERE question_id = '$question_id'";
		$result = mysqli_query($conn, $sql);

		if($result){
			$_SESSION['success'] = 'Question updated successfully!';
			mysqli_close($conn);
			header('Location: question.php?acad_id=' . urlencode($acad_id));
			exit;
		} else{
			$_SESSION['error'] = 'Failed to update question!';
			mysqli_close($conn);
			header('Location: question.php?acad_id=' . urlencode($acad_id));
			exit;
		}

	}
	else{
		$_SESSION['error'] = 'Select question to edit first!';
	}

	header('Location: question.php?acad_id=' . urlencode($acad_id));

?>