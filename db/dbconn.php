<?php
$servername="localhost";
$uname="root";
$pass="";
$dbname="fes_db";

$conn = mysqli_connect($servername, $uname, $pass, $dbname);

if (!$conn) {

	$servername="localhost";
	$uname="u293681336_fes";
	$pass="Moondrop_09";
	$dbname="u293681336_fes";

	$conn = mysqli_connect($servername, $uname, $pass, $dbname);
	
	if (!$conn) {
		echo 'Error connecting to database'.mysqli_connect_error($conn);
}

}
?>