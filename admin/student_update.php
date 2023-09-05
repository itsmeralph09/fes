<?php
	session_start();
	require '../db/dbconn.php';

	if(isset($_POST['edit'])){
		$student_id = $_POST['student_id'];
		$school_id = $_POST['school_id'];
		$first_name = $_POST['first_name'];
		$middle_name = $_POST['middle_name'];
		$last_name = $_POST['last_name'];
		$ext_name = $_POST['ext_name'];
		$email = $_POST['email'];
		$class_id = $_POST['class_ids'];
		$password = $_POST['password'];
		$confirm_password = $_POST['confirm_password'];

		$query_userid = "SELECT * FROM user_tbl WHERE school_id = '" . $school_id . "'";
		$query_result = mysqli_query($conn, $query_userid);
		$query_row = mysqli_fetch_assoc($query_result);
		$user_id = $query_row['user_id'];

		if (empty($password)) {
			$sql = "UPDATE student_tbl SET first_name = '$first_name', middle_name ='$middle_name', last_name = '$last_name',  ext_name = '$ext_name', email='$email', class_id = '$class_id' WHERE student_id = '$student_id'";
			$result = mysqli_query($conn, $sql);
			
			if($result){
						$_SESSION['success'] = 'Student updated successfully, but password remain unchanged!';
					}	
		}else{
			if ($password==$confirm_password) {
				$hashed_pass = password_hash($password, PASSWORD_BCRYPT);
				$sql2 = "UPDATE user_tbl SET password ='$hashed_pass' WHERE user_id ='$user_id'";
				$result2 = mysqli_query($conn, $sql2);

				$sql = "UPDATE student_tbl SET first_name = '$first_name', middle_name ='$middle_name', last_name = '$last_name',  ext_name = '$ext_name', email='$email', class_id = '$class_id' WHERE student_id = '$student_id'";
				$result = mysqli_query($conn, $sql);
				
					if($result || $result2){
						$_SESSION['success'] = 'Student updated successfully, and password changed!';
					}
			}else{
				$_SESSION['error'] = "Passwords do not match!";
			}
		}

	}
	else{
		$_SESSION['error'] = 'Select student to edit first';
	}

	header('location: new_manage_student.php');

?>