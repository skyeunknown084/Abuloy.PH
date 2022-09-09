<?php
ob_start();
date_default_timezone_set("Asia/Manila");

$action = $_GET['action'];

include 'api.php';
$crud = new Action();


if($action == 'update_all_fund_status'){
	$update = $crud->update_all_fund_status();
	if($update)
		echo $update;
}

// end call
ob_end_flush();
?>
