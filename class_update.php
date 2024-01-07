<?php
	session_start();
	require './db/dbconn.php';

	if(isset($_POST['edit'])){
		$school_id = $_POST['school_id'];
		$class_id = $_POST['class_id'];

		$hashed_pass = password_hash($password, PASSWORD_BCRYPT);
		$sql2 = "UPDATE student_tbl SET class_id ='$class_id' WHERE school_id ='$school_id'";
		$result2 = mysqli_query($conn, $sql2);
		
		if($result2){
			$_SESSION['success'] = 'Class Section updated successfully!';
		}else{
			$_SESSION['error'] = 'Failed to update Class Section!';
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