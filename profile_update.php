<?php
	session_start();
	require './db/dbconn.php';

	if(isset($_POST['edit'])){
		$school_id = $_POST['school_id'];
		$password = $_POST['password'];
		$confirm_password = $_POST['confirm_password'];

		if ($password==$confirm_password) {
				$hashed_pass = password_hash($password, PASSWORD_BCRYPT);
				$sql2 = "UPDATE user_tbl SET password ='$hashed_pass' WHERE school_id ='$school_id'";
				$result2 = mysqli_query($conn, $sql2);
				
				if($result2){
					$_SESSION['success'] = 'Password updated successfully!';
				} 
		}else{
				$_SESSION['error'] = "Passwords do not match!";
			}
	}
	else{
		$_SESSION['error'] = 'Select profile to update first!';
	}


    if ($_SESSION['role'] == "student") {
        header("Location: ./student/index.php");
        exit;
    } elseif ($_SESSION['role'] == "faculty") {
        header("Location: ./faculty/index.php");
        exit;
    } elseif ($_SESSION['role'] == "admin") {
        header("Location: ./admin/index.php");
        exit;
    }

?>