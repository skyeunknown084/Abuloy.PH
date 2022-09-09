<?php
// session_start();

ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
		include 'global_call.php';		
		include 'database.php';		
		$this->db = $mysqli;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}


	// Admin Fund Tracking
	function update_all_fund_status(){
		extract($_POST);
		// $value = $_POST['value'];
		$update = $this->db->query("UPDATE abuloy_payments SET payment_status=$value WHERE id = $id");
		if($update){
			return 1;
		}
	}

}