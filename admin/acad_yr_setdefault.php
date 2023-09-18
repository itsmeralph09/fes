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
		if ($row['is_default'] == "yes") {
			$_SESSION['error'] = 'Academic year is already the default!';
			mysqli_close($conn);
			header('location: acad_yr.php');
			exit;
		}


		$sql = "UPDATE acad_yr_tbl
				SET is_default = CASE
				    WHEN acad_id = '$acad_id' THEN 'yes'
				    ELSE 'no'
				END
				WHERE is_default = 'yes' OR acad_id = '$acad_id'";

		$result = mysqli_query($conn, $sql);

		if($result){
			$_SESSION['success'] = 'Academic year successfully set as default !';
			mysqli_close($conn);
			header('location: acad_yr.php');
			exit;
		} else{
			$_SESSION['error'] = 'Failed to set academic year as default!';
			mysqli_close($conn);
			header('location: acad_yr.php');
			exit;
		}

	}
	else{
		$_SESSION['error'] = 'Select academic year to set as default!';
		mysqli_close($conn);
		header('location: acad_yr.php');
		exit;
	}

	header('location: acad_yr.php');

?>