<?php
	session_start();
	require '../db/dbconn.php';

	if(isset($_GET['admin_id']) && isset($_GET['school_id'])){
		$sql = "DELETE FROM admin_tbl WHERE admin_id = '".$_GET['admin_id']."'";
		$sql2 = "DELETE FROM user_tbl WHERE school_id = '".$_GET['school_id']."'";

		if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)){
			$_SESSION['success'] = 'Admin deleted successfully!';
		}

		
		else{
			$_SESSION['error'] = 'Something went wrong in deleting admin!';
		}
	}
	else{
		$_SESSION['error'] = 'Select admin to delete first!';
	}

	header('location: admin.php');
?>