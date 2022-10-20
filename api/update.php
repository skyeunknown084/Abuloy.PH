<?php

require_once 'db.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// get posted data
	$data = json_decode(file_get_contents("php://input", true));
	
	$sql = "UPDATE payments SET 
			account_id = '" . mysqli_real_escape_string($dbConn, $data->account_id) . "',
			account_name = '" . mysqli_real_escape_string($dbConn, $data->account_name) . "',
			donator_name = '" . mysqli_real_escape_string($dbConn, $data->donator_name) . "',
			code = '" . mysqli_real_escape_string($dbConn, $data->code) . "',
			amount = '" . mysqli_real_escape_string($dbConn, $data->amount) . "',
			description = '" . mysqli_real_escape_string($dbConn, $data->description) . "',
			status = '" . mysqli_real_escape_string($dbConn, $data->status) . "',
			customer_name = '" . mysqli_real_escape_string($dbConn, $data->customer_name) . "',
			customer_email = '" . mysqli_real_escape_string($dbConn, $data->customer_email) . "',
			customer_mobile = '" . mysqli_real_escape_string($dbConn, $data->customer_mobile) . "'
			 WHERE id = " . $data->id;
	dbQuery($sql);
}

//End of file