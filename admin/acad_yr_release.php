<?php
	session_start();
	require '../db/dbconn.php';

	if(isset($_GET['acad_id'])){
		$acad_id = $_GET['acad_id'];
		// $year_start = $_POST['year_start'];
		// $year_end = $_POST['year_end'];


		// Check if academic year is already started
		$checkStatusQuery = "SELECT * FROM acad_yr_tbl WHERE acad_id = '$acad_id'";
		$checkStatusResult = mysqli_query($conn, $checkStatusQuery);
		$row = mysqli_fetch_assoc($checkStatusResult);
		if ($row['results_release'] == "yes") {
			$_SESSION['error'] = 'Results for this academic year is already released!';
			mysqli_close($conn);
			header('location: acad_yr.php');
			exit;
		}


		$sql = "UPDATE acad_yr_tbl
				SET results_release = 'yes'
				WHERE acad_id = '$acad_id'";

		$result = mysqli_query($conn, $sql);

		if($result){
			$_SESSION['success'] = 'Academic year results released successfully!';
			mysqli_close($conn);
			header('location: acad_yr.php');
			exit;
		} else{
			$_SESSION['error'] = 'Failed to release results for this academic year!';
			mysqli_close($conn);
			header('location: acad_yr.php');
			exit;
		}

	}
	else{
		$_SESSION['error'] = 'Select academic year to release results first!';
		mysqli_close($conn);
		header('location: acad_yr.php');
		exit;
	}

	header('location: acad_yr.php');

?>