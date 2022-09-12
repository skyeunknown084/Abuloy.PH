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

	// Donation Payment from Donators
	function donation_payment(){
		extract($_POST);
		$uid = "";
		$check = $this->db->query("SELECT * FROM abuloy_payments p INNER JOIN abuloy_accounts a ON(p.aid = a.id) where a.uid = '$uid'  ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(empty($id)){
		
			require_once 'global_call.php';
			$gcash_public_key = $_ENV['GCASH_PK'];

			$curl = curl_init();

			// $customer_name = 'Anonymous';
			$webhooksuccessurl = 'https://abuloy.ph/success';
			$redirectsuccessurl = 'https://abuloy.ph/success';
			$redirectfailurl = 'https://abuloy.ph/fail';

			$payload = json_encode([
				'x-public-key' => $gcash_public_key,
				'amount' => $amount,
				'description' => $description,
				'customername' => $customer_name,
				'webhooksuccessurl' => $webhooksuccessurl,
				'redirectsuccessurl' => $redirectsuccessurl,
				'redirectfailurl' => $redirectfailurl
			]);


			curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://g.payx.ph/payment_request',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => array(
				'x-public-key' => $gcash_public_key,
				'amount' => $amount,
				'description' => $description,
				'customername' => $customer_name,
				'customeremail' => $customer_email,
				'customermobile' => $customer_mobile,
				'webhooksuccessurl' => $webhooksuccessurl,
				'redirectsuccessurl' => $redirectsuccessurl,
				'redirectfailurl' => $redirectfailurl
			)
			));

			$response = curl_exec($curl);

			curl_close($curl);
			echo $response;
			$data = json_decode($response, true);

			$code = $data['data']['code'];
			$amount = $data['data']['amount'];
			$description = $data['data']['description'];
			$checkout_url = $data['data']['checkouturl'];
			$request_id = $data['data']['hash'];
			$customer_name = $data['data']['customername'];
			$customer_email = $data['data']['customeremail'];
			$customer_mobile = $data['data']['customermobile'];

			$env_af = 0.03; //3% - abuloy fee
			$env_gcf = 0.02; //2% - gcash fee
			$admin_fee = $amount * $env_af; // abuloy fee amount ex. 100 x 0.03 = Php 3
			$gcash_fee = $amount * $env_gcf; // gcash fee amount ex. 100 x 0.02 = Php 2
			$total_gcash = $amount - $gcash_fee;  // total amount minus gcash fee
			$total_abuloy = $total_gcash - $admin_fee; // total fund raise minus admin fees
			$total_fee = $admin_fee + $gcash_fee; // total fee (gcash)+(abuloy) 

			$save = $this->db->query("INSERT INTO abuloy_payments (aid, utype, account_name, request_code, amount, fee, gross_amount, total_fee, gcash_fee, admin_fee, total_abuloy, customer_name, customer_email, customer_mobile, request_id, checkout_url, date_added) VALUES ('$account_id', '$account_name', '$user_type', '$donator_name', '$code', '$amount', '$description', '$status', '$total_fee', '$gcash_fee', '$admin_fee', '$total_abuloy', '$customer_name', '$customer_email', '$customer_mobile', '$request_id', '$checkout_url', NOW())");

			
		}else{
			// $save = $this->db->query("UPDATE abuloy_payments (account_id, user_type, gcash_amount, gcash_fee, gcash_abuloy_fee) VALUES ('$account_id', '$user_type', '$gcash_amount', '$gcash_fee', '$gcash_abuloy_fee') WHERE id = $id");
			echo "Insert query failed to create new data for this id !";
		}
	}

	// ==============================================
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