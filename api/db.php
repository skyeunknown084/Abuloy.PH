<?php

// Live Database Config
// $conn= new mysqli('localhost','francisr_abuloy','iAm-Abul0yPH','francisr_abuloydb')or die("Could not connect to mysql".mysqli_error($conn));
// Localhost DB Config
$conn= new mysqli('localhost','root','','francisr_abuloydb')or die("Could not connect to mysql".mysqli_error($conn));


function dbQuery($sql) {
	global $conn;
	$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	return $result;
}

function dbFetchAssoc($result) {
	return mysqli_fetch_assoc($result);
}

function closeConn() {
	global $conn;
	mysqli_close($conn);
}
	
//End of file