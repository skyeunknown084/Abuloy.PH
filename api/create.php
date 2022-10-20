<?php

require_once 'db.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// get posted data
	$data = json_decode(file_get_contents("php://input", true));
	
	$sql = "INSERT INTO payment (account_id, account_name, donator_name, code, amount, description, status, customer_name, customer_email, customer_mobile) 
	VALUES (
		'" . mysqli_real_escape_string($dbConn, $data->account_id) . "',
		'" . mysqli_real_escape_string($dbConn, $data->account_name) . "',
		'" . mysqli_real_escape_string($dbConn, $data->donator_name) . "',
		'" . mysqli_real_escape_string($dbConn, $data->code) . "',
		'" . mysqli_real_escape_string($dbConn, $data->amount) . "',
		'" . mysqli_real_escape_string($dbConn, $data->description) . "',
		'" . mysqli_real_escape_string($dbConn, $data->status) . "',
		'" . mysqli_real_escape_string($dbConn, $data->customer_name) . "',
		'" . mysqli_real_escape_string($dbConn, $data->customer_email) . "',
		'" . mysqli_real_escape_string($dbConn, $data->customer_mobile) . "'
	)";
	dbQuery($sql);
}

//End of file