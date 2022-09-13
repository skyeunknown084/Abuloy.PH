<?php
ob_start();
date_default_timezone_set("Asia/Manila");

$action = $_GET['action'];

include 'api.php';
$crud = new Action();

if($action == 'donation_payment'){
	$save = $crud->donation_payment();
	if($save)
		echo $save;
}

if($action == 'update_code'){
	$update = $crud->update_code();
	if($update)
		echo $update;
}

//===============================================
// Admin Functions
if($action == 'update_all_fund_status'){
	$update = $crud->update_all_fund_status();
	if($update)
		echo $update;
}



// end call
ob_end_flush();
?>
