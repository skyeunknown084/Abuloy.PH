<?php

require_once 'db.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
	$sql = "DELETE FROM payments WHERE id = " . mysqli_real_escape_string($dbConn, $_GET['id']);
	dbQuery($sql);
}

//End of file